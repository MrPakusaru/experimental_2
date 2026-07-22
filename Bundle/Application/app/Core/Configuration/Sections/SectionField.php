<?php

namespace App\Core\Configuration\Sections;

use App\Core\Classes\Checker;
use App\Core\Exceptions\CheckerException;

/**
 * Класс, управляющий параметрами поля модели
 */
final class SectionField
{
    private string $alias;
    private string $column;
    private string $cast;
    private bool $nullable;
    private bool $fillable;

    /**
     * Формирует набор данных поля модели
     *
     * @param Checker $checker
     * @param string $alias
     * @param array $fieldRawData
     * @return self
     * @throws CheckerException
     */
    public static function make(Checker $checker, string $alias, array $fieldRawData): self
    {
        $field = new self();

        $field->alias = $checker->validateParam('alias', $alias, 'required|string');

        $rawData = $checker->validateData($fieldRawData, [
            'column' => 'required',
            'cast' => 'present',
            'requirements' => 'present|array',
        ]);

        $field->column = $checker->validateParam('column', $rawData['column'], 'required|string');
        $field->cast = $checker->validateParam('cast', $rawData['cast'], 'nullable|string');
        $field->nullable = in_array('nullable', $rawData['requirements']);
        $field->fillable = in_array('fillable', $rawData['requirements']);

        return $field;
    }

    /**
     * Возвращает алиас поля
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * Возвращает название колонки в таблице
     * @return string
     */
    public function getColumn(): string
    {
        return $this->column;
    }

    /**
     * Может ли поля иметь значение null
     * @return bool
     */
    public function isNullable(): bool
    {
        return $this->nullable;
    }

    /**
     * Доступно ли поле для массового заполнения
     * @return bool
     */
    public function isFillable(): bool
    {
        return $this->fillable;
    }

    /**
     * Возвращает свойство 'кастинг'
     * @return string
     */
    public function getCast(): string
    {
        return $this->cast;
    }
}
