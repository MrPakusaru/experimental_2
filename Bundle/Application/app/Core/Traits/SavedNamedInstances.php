<?php

namespace App\Core\Traits;

/**
 * Добавляет функционал хранения нескольких именованных экземпляров класса
 */
trait SavedNamedInstances
{
    /**
     * @var array<string,static> Набор собранных экземпляров
     */
    private static array $savedInstances = [];

    /**
     * Возвращает именованный экземпляр класса по ключу-имени
     * @param string $name
     * @return $this
     */
    public static function getInstance(string $name): static
    {
        $instance = static::$savedInstances[$name] ?? null;
        if ($instance instanceof static) {
            return static::$savedInstances[$name];
        }

        return static::$savedInstances[$name] = static::make($name);
    }

    /**
     * Формирует именованный экземпляр класса и возвращает его
     * @param string $name
     * @return static
     */
    abstract protected static function make(string $name): static;
}
