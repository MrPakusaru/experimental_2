<?php

namespace App\Models;

/**
 * Контакт
 *
 * @property $surname
 * @property $name
 * @property $last_name
 * @property $email
 * @property $phone
 * @property $birth_date
 */
final class Contact extends ModelCore
{
    /**
     * @var string Имя конфигурации модели
     */
    public static string $config = 'contact';
}
