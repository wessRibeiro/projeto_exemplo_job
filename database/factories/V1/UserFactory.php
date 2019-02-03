<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(/**
 * Created by Weslley Ribeiro.
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Date 03/02/2019 13:12
 * @param Faker $faker
 * @return array
 */
    Convenia\User::class, function (Faker $faker) {
    return [
        'name'              => 'Convenia',
        'phone'             => '(11) 3090-6074',
        'adress'            => 'Al. Campinas, 977 - 6º andar - Jardim Paulista, São Paulo - SP',
        'postcode'          => '01405-003',
        'email'             => 'root@convenia.com',//$faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password'          => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token'    => str_random(10),
    ];
});
