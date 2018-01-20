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

$factory->define(App\Admin::class, function (Faker $faker) {
	return [
		'username' => 'sonhai' . str_random(1),
		'password' => 999999,
		'fullname' => str_random(10),
		'email' => 'nvhai001@gmail.com',
		'phone' => 12341234,
		'api_token' => str_random(10),
		'avatar' => 'sonhai.jpg',
		'status' => 1,

	];
});
