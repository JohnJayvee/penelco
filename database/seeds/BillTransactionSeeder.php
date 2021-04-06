<?php

use App\Laravel\Models\BillDetails;
use App\Laravel\Models\BillTransaction;
use Illuminate\Database\Seeder;

class BillTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BillDetails::truncate();
        BillTransaction::truncate();

        factory(BillTransaction::class, 100)->create();
    }
}
