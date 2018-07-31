<?php

use Faker\Generator as Faker;
use App\Models\URL;

$factory->define(URL::class, function (Faker $faker) {
    $expiresIn = $faker->dateTimeBetween('-10 days', '+30 days');

    if ($expiresIn < (new DateTime('now'))) {
        $status = URL::STATUS_EXPIRED;
    } else {
        $status = $faker->randomElement([URL::STATUS_ACTIVE, URL::STATUS_DELETED]);
    }

    return [
        'code' => str_random(7),
        'url' => $faker->url,
        'status' => $status,
        'expires_in' => $expiresIn,
    ];
});
