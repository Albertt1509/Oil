<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class COGS extends Model
{
    use HasFactory;
    protected $table = 'cogs';
    protected $fillable = [
        'product_id',
        'purchase_price',
        'selling_price',
        'quantity_sold',
        'total_selling',
        'transaction_date',
        'profit_per_unit',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function booted()
    {
        static::saving(function ($cogs) {
            $stock = \App\Models\Stock::where('product_id', $cogs->product_id)->first();

            if ($stock && empty($cogs->purchase_price)) { $cogs->purchase_price = $stock->price; }

            $cogs->total_selling = $cogs->selling_price * $cogs->quantity_sold;
            $cogs->profit_per_unit = $cogs->selling_price - $cogs->purchase_price;
            $cogs->total_profit = $cogs->profit_per_unit * $cogs->quantity_sold;
        });


        static::saved(function ($cogs) {
            $stock = \App\Models\Stock::where('product_id', $cogs->product_id)->first();

            if ($stock) {
                $stock->onHand = max(0, $stock->onHand - $cogs->quantity_sold);
                $stock->save();
            }
        });
    }
}
