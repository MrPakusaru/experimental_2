<?php

namespace App\Core\Classes;

use App\Core\Exceptions\CheckerException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Factory as Validators;

/**
 * Проверяет данные на соответствие правилам
 */
final readonly class Checker
{
    private Validators $validators;

    /**
     * Возвращает новый экземпляр
     * @return self
     * @throws BindingResolutionException
     */
    public static function new(): self
    {
        $instance = new self();
        $instance->validators = App::make(Validators::class);

        return $instance;
    }

    /**
     * Проводит валидацию параметра на соответствие правилам
     *
     * @param string $fieldName
     * @param mixed $data Значение
     * @param string $rules Правила валидации
     * @return mixed
     * @throws CheckerException
     */
    public function validateParam(string $fieldName, mixed $data, string $rules): mixed
    {
        $validator = $this->validators->make(
            ["fieldname" => $data],
            ["fieldname" => $rules]
        );

        if ($validator->fails()) {
            $msg = str_replace("fieldname", "'{$fieldName}'", $validator->errors()->first());
            throw new CheckerException($msg);
        }

        return $data;
    }

    /**
     * Проводит валидацию набора данных на соответствие правилам
     *
     * @param array $data Набор данных
     * @param array $rules Правила валидации
     * @return array
     * @throws CheckerException
     */
    public function validateData(array $data, array $rules): array
    {
        $validator = $this->validators->make($data, $rules);

        if ($validator->fails()) {
            $msg = str_replace(["The ", " field"], ["The '", "' field"], $validator->errors()->first());
            throw new CheckerException($msg);
        }

        return $data;
    }
}
