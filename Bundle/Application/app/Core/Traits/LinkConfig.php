<?php

namespace App\Core\Traits;

use App\Core\Attributes\LinkedConfig;
use Exception;
use ReflectionClass;

trait LinkConfig
{
    /**
     * @return void
     * @throws Exception
     */
    public function initializeLinkConfig(): void
    {
        $attributes = (new ReflectionClass($this))->getAttributes(LinkedConfig::class);
        if (empty($attributes)) {
            throw new Exception('Отсутствует привязка конфигурации модели!'); //TODO: поправить ошибки
        }

        $this->linkedConfig = $attributes[0]->newInstance()->configName;
        if (empty($this->linkedConfig)) {
            throw new Exception('Отсутствует название конфигурации модели!'); //TODO: поправить ошибки
        }
    }
}
