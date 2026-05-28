<?php

namespace App\Core\Configuration\Objects;

/**
 * Корневые данные модели
 */
final class ModelCoreConfig
{
    /**
     * TODO добавить подпись
     */
    private const string CONFIG_DATA_KEY = 'core';

    public function __construct(
        private readonly string $table,
        private readonly string $connection,
        private readonly array $availableParams
    ) {
    }

    /**
     * TODO добавить подпись
     * @param array $data
     * @return ModelCoreConfig
     */
    public static function make(array $data): self
    {
        $coreData = $data[self::CONFIG_DATA_KEY];

        return new self(
            $coreData['table'],
            $coreData['connection'] ?? '',
            $coreData['available_params']
        );
    }

    /**
     * Возвращает название связанной таблицы
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * Возвращает название установленного соединения к БД
     * @return string
     */
    public function getConnection(): string
    {
        return $this->connection;
    }

    /**
     * Возвращает параметры особенностей модели
     * @return array
     */
    public function getAvailableParams(): array
    {
        return $this->availableParams;
    }
}
