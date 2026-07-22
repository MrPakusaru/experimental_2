<?php

namespace App\Core\Traits;

/**
 * Добавляет классу функционал хранения нескольких своих именованных экземпляров
 */
trait SavedNamedInstances
{
    /**
     * @var array<string,static> Набор собранных экземпляров
     */
    private static array $savedInstances = [];

    /**
     * Возвращает именованный экземпляр по ключу-имени
     * @param string $name
     * @return $this
     */
    public static function make(string $name): static
    {
        $instance = static::$savedInstances[$name] ?? null;
        if ($instance instanceof static) {
            return static::$savedInstances[$name];
        }

        return static::$savedInstances[$name] = new static($name);
    }
}
