<?php

namespace App\Core\Configuration\Sections;

use App\Core\Classes\Checker;
use App\Core\Exceptions\CheckerException;

final class SectionField
{
    private string $alias;
    private string $column;
    private string $cast;
    private bool $nullable;

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
     * TODO
     * @return bool
     */
    public function isNullable(): bool
    {
        return $this->nullable;
    }

    /**
     * Возвращает спаренное значение (alias) -> (COL_NAME)
     * @param bool $inverted Нужно ли инвертировать ключ-значение (COL_NAME) -> (alias)
     * @return array<string,string>
     */
    public function getAliasColumn(bool $inverted = false): array
    {
        /* [COL_NAME => alias] */
        if ($inverted) {
            return [$this->column => $this->alias];
        }

        /* [alias => COL_NAME] */
        return [$this->alias => $this->column];
    }

    /**
     * Возвращает спаренное значение (alias) -> (cast)
     * @return string[]
     */
    public function getAliasCast(): array
    {
        return [$this->alias => $this->cast];
    }
}
