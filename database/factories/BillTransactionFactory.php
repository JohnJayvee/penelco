<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Laravel\Models\BillDetails;
use App\Laravel\Models\BillTransaction;
use Faker\Generator as Faker;

$factory->define(BillTransaction::class, function (Faker $faker) {
    return [
        'bill_id' => factory(BillDetails::class),
    ];
});
