<?php

namespace App\Models;

use App\Core\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    use HasFactory;
    /**
     * @var string Имя конфигурации модели
     */
    public static string $config = 'contact';
}
