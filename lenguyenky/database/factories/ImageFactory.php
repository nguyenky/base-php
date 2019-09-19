<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    $width = rand(100, 200);
    $height = rand(100, 200);

    return [
        'channel_id' => function () {
            return factory(\App\Models\Channel::class)->create()->id;
        },
        'title' => $faker->title,
        'description' => $faker->text,
        'url' => $faker->imageUrl($width, $height),
        'link' => $faker->url,
        'width' => $width,
        'height' => $height,
    ];
});
