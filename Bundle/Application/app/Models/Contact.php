<?php

namespace App\Models;

use App\Core\Model;

/**
 * Контакт
 *
 * @property $user_link
 * @property $surname
 * @property $name
 * @property $last_name
 * @property $email
 * @property $phone
 * @property $birth_date
 */
final class Contact extends Model
{
    /**
     * @var string Имя конфигурации модели
     */
    public static string $config = 'contact';
}
