<?php

namespace App\Core\Classes;

use App\Core\Exceptions\ConfigException;

class ModelConfiguration
{
    /**+
     * @var array Корневые данные модели
     */
    private array $core;
    /**
     * @var array Данные полей модели
     */
    private array $fields;
    /**
     * @var array Данные отношений модели к другим
     */
    private array $relations;

    /**
     * Собирается по данным из конфигурации модели
     * @throws ConfigException
     */
    public function __construct(string $configName)
    {
        $data = static::getConfigData($configName);
        $this->dataInitialize($data);
    }

    /**
     * Наполняет поля данными из конфигурации модели
     * @throws ConfigException
     */
    private function dataInitialize(array $data): void
    {
        static::checkSection('core', $data);
        $this->core = $data['core'];

        static::checkSection('fields', $data);
        $this->fields = $data['fields'];

        static::checkSection('relations', $data);
        $this->relations = $data['relations'];
    }

    /**
     * Получает данные конфигурации по названию
     * @throws ConfigException
     */
    private static function getConfigData($name): array
    {
        $data = config("models.{$name}", []);
        if (empty($data)) {
            throw new ConfigException(static::class, "Конфигурация '{$name}' отсутствует");
        }
        return $data;
    }

    /**
     * Проверяет раздел на существование
     * @var string $nameNode Название раздела
     * @var array $data Массив данных
     * @throws ConfigException
     */
    private static function checkSection(string $nameNode, array $data): void
    {
        if (!isset($data[$nameNode])) {
            throw new ConfigException(static::class, "В конфигурации модели отсутствует поле [{$nameNode}]");
        }
    }

    /**
     * Возвращает корневые данные модели
     * @return array
     */
    public function getCoreData(): array
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
     * Возвращает данные отношений модели к другим
     * @return array
     */
    public function getRelationsData(): array
    {
        return $this->relations;
    }
}
