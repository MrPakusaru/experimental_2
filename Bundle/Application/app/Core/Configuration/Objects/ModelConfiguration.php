<?php

namespace App\Core\Configuration\Objects;

use App\Core\Configuration\ModelConfigurationChecker;
use App\Core\Exceptions\ConfigException;

/**
 * TODO добавить подпись
 */
class ModelConfiguration
{
    /**
     * Расположение конфигурации моделей по умолчанию
     */
    private const string DEFAULT_CONFIG_LOCATION = 'core.models';

    /**
     * Сырые данные конфигурации
     */
    private array $rawData;

    /**
     * Корневые данные модели
     */
    private ModelCoreConfig $core;

    /**
     * Данные полей модели
     */
    private array $fields;

    /**
     * Данные отношений модели к другим
     */
    private array $relations;

    /**
     * Собирается по данным из конфигурации модели
     * @throws ConfigException
     */
    public function __construct(string $configName)
    {
        $this->getConfigData($configName);
        $this->initData();
    }

    /**
     * Наполняет поля данными из конфигурации модели
     */
    private function initData(): void
    {
        $this->core = ModelCoreConfig::make($this->rawData);

        $this->fields = $this->rawData['fields'];

        $this->relations = $this->rawData['relations'];
    }

    /**
     * Получает данные конфигурации по её названию
     * @throws ConfigException
     */
    private function getConfigData($name): void
    {
        $modelConfigLocation = static::DEFAULT_CONFIG_LOCATION . '.' . $name;
        $this->rawData = config($modelConfigLocation, []);
        $this->validate();
    }

    /**
     * Возвращает корневые данные модели
     * @return ModelCoreConfig
     */
    public function getCoreData(): ModelCoreConfig
    {
        return $this->core;
    }

    /**
     * Возвращает данные полей модели
     * @return array
     */
    public function getFieldsData(): array
    {
        return $this->fields;
    }

    /**
     * Возвращает маппинг колонок в БД на алиасы полей в конфигурации
     *
     * По умолчанию возвращает [alias => COL_NAME]. При инверсии [COL_NAME => alias]
     * @param bool $isInverted
     * @return array
     */
    public function getFieldsAliasesMap(bool $isInverted = false): array
    {
        /* [alias => COL_NAME] */
        if (!$isInverted) {
            return array_map(fn ($field) => $field['column'], $this->fields);
        }

        /* [COL_NAME => alias] */
        $columnAliasesMap = [];
        foreach ($this->fields as $alias => $field) {
            $columnAliasesMap[$field['column']] = $alias;
        }
        return $columnAliasesMap;
    }

    /**
     * Возвращает данные отношений модели к другим
     * @return array
     */
    public function getRelationsData(): array
    {
        return $this->relations;
    }

    /**
     * TODO добавить подпись
     * @throws ConfigException
     */
    public function validate(): void
    {
        ModelConfigurationChecker::new(static::class)->validate($this->rawData);
    }
}
