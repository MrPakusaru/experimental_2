<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Contact>
 */
class ContactFactory extends Factory
{
    protected $model = Contact::class;
    /**
     * @inheritDoc
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('ru_RU');
        /* Определить пол (male или female) */
        $gender = $faker->randomElement(['male', 'female']);

        // Генерируем отчество вручную в зависимости от пола
        $middleName = ($gender === 'male')
            ? $faker->middleNameMale()
            : $faker->middleNameFemale();

        return [
            'user_link' => 1,
            'name' => $faker->firstName($gender),
            'surname' => $faker->lastName($gender),
            'middle_name' => $middleName,

            'email' => $faker->unique()->safeEmail(),
            'phone' => $faker->numerify('+79#########'),
            'birth_date' => $faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
        ];
    }
}
