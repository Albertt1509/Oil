<?php

namespace App\Services;

use App\Models\Stock;
use App\Models\COGS;
use Carbon\Carbon;

class HppService
{
    public static function hitungHpp($year, $month)
    {
        $start = Carbon::create($year, $month, 1)->startOfMonth();
        $end   = Carbon::create($year, $month, 1)->endOfMonth();

        $persediaanAwal = Stock::sum('onHand') * Stock::avg('price'); 

        $pembelianBersih = COGS::whereBetween('transaction_date', [$start, $end])
            ->sum('total_cost');

        $persediaanAkhir = Stock::sum('totalonHand') * Stock::avg('price');

        $hpp = ($persediaanAwal + $pembelianBersih) - $persediaanAkhir;

        return [
            'persediaan_awal'   => $persediaanAwal,
            'pembelian_bersih'  => $pembelianBersih,
            'persediaan_akhir'  => $persediaanAkhir,
            'hpp'               => $hpp,
        ];
    }
}
