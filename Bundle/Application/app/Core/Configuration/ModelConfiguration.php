<?php

namespace App\Core\Configuration;

use App\Core\Classes\Checker;
use App\Core\Configuration\Sections\SectionCore;
use App\Core\Configuration\Sections\SectionFields;
use App\Core\Exceptions\CheckerException;
use App\Core\Exceptions\ConfigException;
use App\Core\Traits\SavedNamedInstances;

/**
 * Содержит обработанные параметры модели
 */
class ModelConfiguration
{
    use SavedNamedInstances;

    /**
     * Расположение конфигурации моделей по умолчанию
     */
    private const string DEFAULT_CONFIG_LOCATION = 'core.models';

    /**
     * @var Checker Класс, проверяющий корректность данных
     */
    private Checker $checker;

    /**
     * Сырые данные конфигурации
     */
    private array $rawData;

    /**
     * Корневые данные модели
     */
    private SectionCore $core;

    /**
     * Данные полей модели
     */
    private SectionFields $fields;

    /**
     * Данные отношений модели к другим
     */
    private array $relations;

    /**
     * Собирается по данным из конфигурации модели
     * @throws CheckerException
     * @throws ConfigException
     */
    public function __construct(string $configName)
    {
        $this->checker = new Checker();

        $this->getConfigData($configName);
        $this->initData();
    }

    /**
     * Наполняет поля данными из конфигурации модели
     * @throws ConfigException
     * @throws CheckerException
     */
    private function initData(): void
    {
        $this->core = SectionCore::make($this->checker, $this->rawData);
        $this->fields = SectionFields::makeSet($this->checker, $this->rawData);
        $this->relations = $this->rawData['relations']; //TODO
    }

    /**
     * Получает данные конфигурации по её названию
     */
    private function getConfigData($name): void
    {
        $modelConfigLocation = static::DEFAULT_CONFIG_LOCATION . '.' . $name;
        $this->rawData = config($modelConfigLocation, []);
    }

    /**
     * Возвращает корневые данные модели
     * @return SectionCore
     */
    public function getCoreData(): SectionCore
    {
        return $this->core;
    }

    /**
     * Возвращает данные полей модели
     * @return SectionFields
     */
    public function getFields(): SectionFields
    {
        return $this->fields;
    }

    /**
     * Возвращает данные отношений модели к другим
     * @return array
     */
    public function getRelationsData(): array
    {
        return $this->relations;
    }
}
