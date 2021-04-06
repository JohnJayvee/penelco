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

        factory(BillTransaction::class, 10)->states('appTransactionCode', 'paid', 'pending')->create();
        factory(BillTransaction::class, 10)->states('appTransactionCode', 'paid')->create();
        factory(BillTransaction::class, 10)->states('appTransactionCode', 'pending')->create();
        factory(BillTransaction::class, 10)->state('btTransactionCode', 'paid', 'pending')->create();
        factory(BillTransaction::class, 10)->state('btTransactionCode', 'paid')->create();
        factory(BillTransaction::class, 10)->state('btTransactionCode', 'pending')->create();
        factory(BillTransaction::class, 10)->state('pfTransactionCode', 'paid', 'pending')->create();
        factory(BillTransaction::class, 10)->state('pfTransactionCode', 'paid')->create();
        factory(BillTransaction::class, 10)->state('pfTransactionCode', 'pending')->create();

        foreach (range(1, 10) as $i) {
            factory(BillTransaction::class)->create([
                'bill_id' => factory(BillDetails::class)->states('partial')->create()->id,
            ]);
        }
    }
}
