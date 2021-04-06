<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Laravel\Models\BillDetails;
use Faker\Generator as Faker;

$factory->define(BillDetails::class, function (Faker $faker) {
    return [

    ];
})->state(BillDetails::class, 'partial', function (Faker $faker) {
    return [
        'requested_partial' => 1,
    ];
});
