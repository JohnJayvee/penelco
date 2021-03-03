<?php 

namespace App\Laravel\Models\Imports;

use App\Laravel\Models\{BillDetails,BillTransaction};

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;


use Str, Helper, Carbon,Event;

class OrderImport implements ToCollection
{
    public function collection(Collection $rows)
    {
       
        foreach ($rows as $index => $row) 
        {  
            if($index == 0) {
                continue;
            }

            $is_exist_bill_month = BillDetails::where('bill_month',$row[0])->first();
            $is_exist_account_number = BillDetails::where('account_number',$row[1])->first();
            if ($is_exist_bill_month and $is_exist_account_number) {
                session()->put('import_message',"yes");
            }
            if (!$is_exist_bill_month and $row[4] != NULL and !$is_exist_account_number) {
                   
                $order_details = BillDetails::create([
                    $bill_month = intval($row[0]),
                    $due_date = intval($row[3]),
                    'bill_month' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($bill_month)->format('Y-m-d'),
                    'account_number' => $row[1],
                    'account_name' => $row[2],
                    'due_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($due_date)->format('Y-m-d'),
                    'amount' => $row[4],
                    'email' => $row[5],
                    'contact_number' => $row[6],
                    'payment_status' => "PENDING",
                ]);
                $order_details->save();
            }
            
        }
        

    }
}