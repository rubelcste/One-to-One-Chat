<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'from' => function(){
        	return App\User::all()->random();
        },
        'to' => function(){
        	return App\User::all()->random();
        },
        'message' => $faker->paragraph,
        'type' =>$faker->boolean(),
    ];
});
