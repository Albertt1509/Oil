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

            $date = \Carbon\Carbon::parse($stock->transaction_date ?? now())->toDateString();

            \App\Models\COGS::updateOrCreate(
                [
                    'product_id'       => $stock->product_id,
                    'transaction_date' => $date,
                ],
                [
                    'purchase_price'   => $stock->price,
                    'selling_price'    => 0,
                    'quantity_sold'    => 0,
                    'total_selling'    => $totalCost,
                    'profit_per_unit'  => 0,
                ]
            );
        });
    }
}
