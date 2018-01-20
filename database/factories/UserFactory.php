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

$factory->define(App\User::class, function (Faker $faker) {
	return [
		'username' => 'sonhai' . str_random(1),
		'password' => 12341234,
		'fullname' => str_random(10),
		'email' => 'nvhai001@gmail.com',
		'phone' => 12341234,
		// 'role' => 2,
		'status' => 1,

	];
});
