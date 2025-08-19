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
            $cogs->total_selling   = $cogs->selling_price * $cogs->quantity_sold;
            $cogs->profit_per_unit = $cogs->total_selling - $cogs->purchase_price;
        });
    }

}
