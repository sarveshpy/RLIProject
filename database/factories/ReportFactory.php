<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Race;
use App\Report;
use App\Driver;
use Faker\Generator as Faker;

$factory->define(Report::class, function (Faker $faker) {
    return [
        'race_id' => factory(Race::class)->create(),
        'reporting_driver' => factory(Driver::class)->create(),
        'reported_against' => factory(Driver::class)->create(),
        'lap' => $faker->randomNumber,
        'explanation' => $faker->paragraph,
        'verdict_message' => $faker->optional()->sentence,
        'proof' => $faker->url,
        'stewards_notes' => $faker->optional()->sentence,
        'verdict_pp' => $faker->randomFloat(2, 0, 0.5),
        'verdict_time' => $faker->randomFloat(2),
        'resolved' => $faker->numberBetween(0, 3),
        'message_id' => $faker->optional()->regexify('[1-9][0-9]{17}'),
        'created_at' => $faker->optional()->datetime()->format('Y-m-d H:i:s'),
        'updated_at' => $faker->optional()->datetime()->format('Y-m-d H:i:s'),
        'report_game' => (int)$faker->boolean,
    ];
});
