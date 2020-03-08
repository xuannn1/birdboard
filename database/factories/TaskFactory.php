<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;
use App\Project;
use App\User;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence,
        'owner_id' => factory(User::class),
        'project_id' => factory(Project::class),
        'completed' => false,
    ];
});
