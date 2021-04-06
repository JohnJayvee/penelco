<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Laravel\Models\BillDetails;
use App\Laravel\Models\BillTransaction;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(BillTransaction::class, function (Faker $faker) {
    return [
        'bill_id' => factory(BillDetails::class),
        'account_number' => Str::upper($faker->bothify('???###')),
        'transaction_code' => $faker->numerify($faker->randomElement(['APP', 'BT', 'PF']) . '-###'),
        'transaction_status' => $faker->randomElement(['PENDING']),
        'payment_status' => $faker->randomElement(['PAID', 'UNPAID']),
    ];
})->state(BillTransaction::class, 'appTransactionCode', function (Faker $faker) {
    return [
        'transaction_code' => $faker->numerify('APP-###'),
    ];
})->state(BillTransaction::class, 'btTransactionCode', function (Faker $faker) {
    return [
        'transaction_code' => $faker->numerify('BT-###'),
    ];
})->state(BillTransaction::class, 'pfTransactionCode', function (Faker $faker) {
    return [
        'transaction_code' => $faker->numerify('PF-###'),
    ];
})->state(BillTransaction::class, 'paid', function (Faker $faker) {
    return [
        'payment_status' => 'PAID',
    ];
})->state(BillTransaction::class, 'pending', function (Faker $faker) {
    return [
        'transaction_status' => 'PENDING',
    ];
});
