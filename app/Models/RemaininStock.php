<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemaininStock extends Model
{
    use HasFactory;

       protected $fillable = [
        'sale',
        'stock',
        'transaction_date',
        'product_id',
        'category_id',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
