<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('bill_month')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_number')->nullable();
            $table->date('due_date')->nullable();
            $table->string('amount')->nullable();
            $table->string('payment_status')->default("PENDING")->nullable();
            $table->string('created_transaction')->default("0")->nullable();
            $table->string('requested_partial')->default("0")->nullable();
            $table->string('partial_amount')->nullable();
            $table->string('partial_status')->default("PENDING")->nullable();
            $table->string('remarks')->nullable();
            $table->datetime('request_date')->nullable();
            $table->datetime('process_date')->nullable();


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_details');
    }
}
