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

$factory->define(
 /**
 * Created by Weslley Ribeiro.
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Date 03/02/2019 13:12
 * @param Faker $faker
 * @return array
 */
    Convenia\Models\V1\Provider::class, function (Faker $faker) {
        return [
            'users_id'  =>   1,
            'name'      =>   $faker->company,
            'email'     =>   $faker->companyEmail,
            'monthly'   =>  $faker->randomFloat(2,100,10000),
        ];
});
