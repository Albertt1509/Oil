<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'category_id',
        'onHand',
        'price',
        'transaction_date',
        'isGoing',
        'totalonHand',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'product_id');
    }

    protected static function booted()
    {
        static::created(function ($stock) {
            $totalCost = $stock->onHand * $stock->price;

            \App\Models\COGS::create([
                'product_id'       => $stock->product_id,
                'purchase_price'   => $stock->price,
                'selling_price'    => 0,
                'quantity_sold'    => 0,
                'total_selling'       => $totalCost,
                'transaction_date' => $stock->transaction_date ?? now(),
                'profit_per_unit' => 0,
            ])->save();
        });
    }
}
