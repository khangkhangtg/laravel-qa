<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Answer::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraphs(rand(1,6), true),
        'user_id' => App\User::pluck('id')->random(),
        // 'votes_count' => rand(1,5)
    ];
});
