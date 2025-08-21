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
        // hitung total selling
        $cogs->total_selling = $cogs->selling_price * $cogs->quantity_sold;

        // hitung profit
        $cogs->profit_per_unit = $cogs->total_selling > 0
            ? ($cogs->selling_price - $cogs->purchase_price) * $cogs->quantity_sold
            : 0;
    });

    static::saved(function ($cogs) {
        // cari stock berdasarkan product_id
        $stock = \App\Models\Stock::where('product_id', $cogs->product_id)->first();

        if ($stock) {
            // kurangi stok sesuai jumlah terjual
            $stock->onHand = max(0, $stock->onHand - $cogs->quantity_sold);
            $stock->save();
        }
    });
}


}
