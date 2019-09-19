<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Channel;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Channel::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->text,
        'link' => $faker->url,
        'category' => $faker->title,
        'copyright' => $faker->name,
        'docs' => $faker->url,
        'language' => $faker->languageCode,
        'lastBuildDate' => $faker->dateTime(),
        'managingEditor' => $faker->email,
        'pub_date' => $faker->dateTime(),
        'webMaster' => $faker->email,
        'generator' => Str::random(10)
    ];
});
