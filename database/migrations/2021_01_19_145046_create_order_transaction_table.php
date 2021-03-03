<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bill_id')->nullable();
            $table->string('account_number')->nullable();
            $table->string('transaction_code')->nullable();
            $table->string('payor')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_number')->nullable();

            $table->string('payment_reference')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_option')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default("UNPAID")->nullable();
            $table->string('transaction_status')->default("PENDING")->nullable();
            $table->string('convenience_fee')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('eor_url')->nullable();
            $table->string('is_email_send')->default(0)->nullable();
            $table->string('process_by')->nullable();
            $table->string('bill_type')->default("FULL")->nullable();
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
        Schema::dropIfExists('bill_transaction');
    }
}
