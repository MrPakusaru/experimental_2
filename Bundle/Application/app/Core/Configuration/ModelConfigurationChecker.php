<?php

namespace App\Core\Configuration;

use App\Core\Exceptions\ConfigException;
use Illuminate\Support\Facades\Validator;

final class ModelConfigurationChecker
{
    /**
     * Расположение конфигурации моделей
     */
    private const string VALIDATION_CONFIG_LOCATION = 'core.validation.model';

    /**
     * TODO добавить подпись
     */
    private string $className;

    /**
     * TODO добавить подпись
     * @param string $className TODO добавить подпись
     * @return self
     */
    public static function new(string $className): self
    {
        $instance = new self();
        $instance->className = $className;
        return $instance;
    }

    /**
     * Проводит валидацию конфигурации модели
     * @throws ConfigException
     */
    public function validate(array $configData): void
    {
        $rules = config(self::VALIDATION_CONFIG_LOCATION, []);
        if (empty($rules)) {
            return;
        }

        $validator = Validator::make($configData, $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            $text = implode(', ' . PHP_EOL, $errors);
            throw new ConfigException($this->className, $text);
        }
    }
}
