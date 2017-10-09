<?php

use Faker\Generator as Faker;

$factory->define(App\ProjectSpace::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->domainWord),
        'description' => $faker->text(200),
        'password' => $faker->password,
    ];
});
