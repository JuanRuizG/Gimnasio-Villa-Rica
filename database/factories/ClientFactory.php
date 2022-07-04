<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    $iden = $faker->isbn10;
    return [
        'name' => $faker->name,
        'phone' => $faker->tollFreePhoneNumber,
        'email' => $faker->safeEmail,
        'type_identification' => $faker->randomElement(['TI','CC']),
        'identification' => $iden,
        'key_identification' => substr($iden,-4),
        'type_monthly_pay' => $faker->randomElement(config('enum.type_monthly')),
        'initial_date' => now(),
    ];
});
