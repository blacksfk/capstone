<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Event::class, function(Faker\Generator $faker) {
    $start_date = $faker->dateTimeBetween("-1 year", "+1 year", "Australia/Melbourne");
    $end_date = $faker->dateTimeInInterval($start_date, "+" . rand(0, 7) . " days", "Australia/Melbourne");
    $start_time = $start_date->format("H:i:s");
    $end_time = $end_date->format("H:i:s");

    return [
        "name" => $faker->name,
        "start_date" => $start_date->format("Y-m-d"),
        "end_date" => $end_date->format("Y-m-d"),
        "start_time" => $start_time,
        "end_time" => $end_time,
        "notes" => $faker->realText()
    ];
});

$factory->define(App\Link::class, function(Faker\Generator $faker) {
    return [
        "name" => $faker->word,
        "active" => false,
        "parent_id" => ""
    ];
});

$factory->define(App\Page::class, function(Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "link_id" => App\Link::all()->random(1)->id
    ];
});