<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

use App\Request;

$factory->define(Request::class, function (Faker $faker) {
    return [
      'email'   => $faker -> email,
      'message' => $faker -> paragraph($nbSentences = 3, $variableNbSentences = true)
    ];
});
