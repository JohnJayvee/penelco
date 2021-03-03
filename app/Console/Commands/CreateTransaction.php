<?php

namespace App\Console\Commands;
use App\Laravel\Requests\PageRequest;
use Illuminate\Console\Command;
use App\Laravel\Models\{BillTransaction,BillDetails};
use App\Laravel\Events\SendBillTransactionEmail;

use Carbon,Auth,DB,Str,ImageUploader,Event,FileUploader,PDF,QrCode,Helper,Curl,Log;

class CreateTransaction extends Command
{
    

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:createtransaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(PageRequest $request)
    {
        $data= BillDetails::where('created_transaction', 0)->take(100)->get();

        if ($data) {
            foreach ($data as $key => $value) {
            $sum_amount = BillDetails::where('account_number',$value->account_number)->where('id',$value->id)->sum('amount');

            BillTransaction::firstOrCreate(
                ['bill_id' => $value->id],
                [
                    'payor' => $value->account_name , 
                    'account_number' => $value->account_number,
                    'contact_number' => $value->contact_number,
                    'email' => $value->email,
                    'transaction_code' => 'BT-' . Helper::date_format(Carbon::now(), 'ym') . str_pad($value->id, 5, "0", STR_PAD_LEFT) . Str::upper(Str::random(3))
                ]);

                BillDetails::where('account_number',$value->account_number)->where('id',$value->id)->update(["created_transaction" => "1"]);
                BillTransaction::where('account_number',$value->account_number)->where('bill_id' , $value->id)->update(["total_amount" => $sum_amount]);
            }
        }
    }
}
