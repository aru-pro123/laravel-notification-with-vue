<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Notification;
use Faker\Generator as Faker;

$factory->define(Notification::class, function (Faker $faker) {
    return [
        'id'  => $faker->uuid(),
        'type' => "App\Notification\UserRegistred",
        'notifiable_type' => "App\User",
        'notifiable_id' => 1,
        'data' => [
            'title' => $faker->title(),
            'description' => $faker->sentence(),
            'target' =>$faker->url(),
        ],
    ];
});
