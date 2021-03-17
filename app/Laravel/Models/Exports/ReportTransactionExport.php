<?php

namespace App\Laravel\Models\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Schedule;

use Helper,Str,Carbon;

class  ReportTransactionExport implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize
{
    use Exportable;

    public function __construct(Collection $transactions)
    {
        $this->transactions = $transactions;
    }

    public function headings(): array
        {
            return [
                'Bill Month',
                'Account Number',
                'Transaction Code',
                "Account Name",
                "Due Date",
                "Amount",
                "Status",
                
            ];
        }

    public function map($value): array
    {
        return [
            Helper::date_only($value->bill_month),
            $value->account_number,
            Helper::get_transaction_number($value->id),
            $value->account_name,
            Helper::date_only($value->account_name),
            Helper::money_format($value->amount ?: 0),
            Str::title($value->payment_status),
            
        ];
    }



    public function collection()
    {
        return $this->transactions;
    }

    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class    => function(AfterSheet $event) {
    //             $cellRange = 'A1:I100'; 
    //             $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
    //             $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(30);
    //         },
    //     ];
    // }
}