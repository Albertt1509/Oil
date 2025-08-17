<?php

namespace App\Exports;

use App\Models\COGS;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CogsExport implements FromQuery, WithHeadings, WithMapping
{
    protected $month;
    protected $year;

    public function __construct($year = null, $month = null)
    {
        $this->year  = $year ?? now()->year;
        $this->month = $month ?? now()->month;
    }

    public function query()
    {
        return COGS::query()
            ->when($this->year && $this->month, fn($q) => 
                $q->whereYear('transaction_date', $this->year)
                  ->whereMonth('transaction_date', $this->month)
            );
    }

    public function headings(): array
    {
        return [
            'Product ID',
            'Purchase Price',
            'Quantity Sold',
            'Total Cost',
            'COGS',
            'Transaction Date',
        ];
    }

    public function map($cogs): array
    {
        return [
            $cogs->product_id,
            $cogs->purchase_price,
            $cogs->quantity_sold,
            $cogs->total_cost,
            $cogs->quantity_sold * $cogs->purchase_price, // HPP
            $cogs->transaction_date->format('Y-m-d'),
        ];
    }
}
