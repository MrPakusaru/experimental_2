<?php

namespace App\Models;

use App\Core\Classes\Assertor;
use App\Core\Traits\LinkConfig;
use Exception;
use Illuminate\Database\Eloquent\Model;

class ModelCore extends Model
{
    use LinkConfig;

    /**
     * @throws Exception
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $assertor = new Assertor(static::class, $this->linkedConfig);
        $assertor->assert($this);
    }
}
