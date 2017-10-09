<?php

use Faker\Generator as Faker;

$factory->define(\App\Setting::class, function (Faker $faker) {
    $key = $faker->word;

    return [
        'namespace'    => $faker->domainWord,
        'key'          => $key,
        'value'        => null,
        'type' => 'string',
        'display_name' => ucfirst($key),
        'description'  => $faker->sentence,
    ];
});
