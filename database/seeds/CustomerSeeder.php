<?php

use App\Laravel\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::truncate();

        factory(Customer::class)->create([
            'fname' => 'Alice',
            'lname' => 'Alpha',
        ]);
    }
}
