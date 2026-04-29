<?php

namespace App\Core\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class LinkedConfig
{
    public function __construct(public string $configName)
    {
    }
}
