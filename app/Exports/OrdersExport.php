<?php
namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    protected $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        return $this->orders->map(function ($order) {
            return [
                'Order ID' => $order->id,
                'Product' => $order->product->name,
                'Amount (USD)' => $order->amount_usd,
                'Amount (INR)' => $order->amount_inr,
                'Status' => ucfirst($order->status),
                'Placed On' => $order->created_at->toDateString(),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Product',
            'Amount (USD)',
            'Amount (INR)',
            'Status',
            'Placed On',
        ];
    }
}
