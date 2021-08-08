<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrderExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::all();
    }

    public function map($order) : array {
        return [
            $order->id,
            $order->code,
            $order->cashier_name,
            $order->total,
            $order->pay,
            $order->change,
            Carbon::parse($order->created_at)->isoFormat('D MMMM YYYY')
        ];


    }

    public function headings() : array {
        return [
           '#',
           'No Invoice',
           'Cashier name',
           'Total',
           'Pay',
           'Changer',
           'Purchase Date'
        ] ;
    }
}
