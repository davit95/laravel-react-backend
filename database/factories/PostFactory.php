<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'text' => $faker->text,
        'image' => Str::random(20).'.png',
        'author' => $faker->name,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ];
});
