<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'channel_id' => function () {
            return factory(\App\Models\Channel::class)->create()->id;
        },
        'title' => $faker->title,
        'description' => $faker->text,
        'link' => $faker->url,
        'category' => $faker->title,
        'category' => $faker->title,
        'pub_date' => $faker->dateTime(),
    ];
});
