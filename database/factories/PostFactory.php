<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraphs,
        'display_title' => $faker->word,
        'display_subtitle' => $faker->word,
        'thumbnail' => $faker->imageUrl,
        'pinned' => $faker->boolean(20)
    ];
});
