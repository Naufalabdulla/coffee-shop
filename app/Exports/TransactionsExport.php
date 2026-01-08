<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Transaction::select(
            'order_id',
            'user_id',
            'total',
            'status',
            'payment_status',
            'created_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'User ID',
            'Total',
            'Status',
            'Payment Status',
            'Created At',
        ];
    }
}
