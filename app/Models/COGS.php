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
        'quantity_sold',
        'total_cost',
        'transaction_date',
    ];

       public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
