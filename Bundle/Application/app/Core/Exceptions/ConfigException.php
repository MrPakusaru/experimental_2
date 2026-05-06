<?php

namespace App\Core\Exceptions;

class ConfigException extends \Exception
{
    public function __construct(string $className = '', string $message = '')
    {
        $text = ($className !== '' ? "[{$className}] " : '') . $message;
        parent::__construct($text);
    }
}
