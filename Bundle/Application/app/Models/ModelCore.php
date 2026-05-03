<?php

namespace App\Models;

use App\Core\Classes\Configurator;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Базовая модель
 */
class ModelCore extends Model
{
    /**
     * Создаёт новый экземпляр модели
     * @throws Exception
     */
    public function __construct(array $attributes = [])
    {
        static::whenBooted(function () {
            (new Configurator($this))->configure();
        });
        parent::__construct($attributes);
    }
}
