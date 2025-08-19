<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_amount',
        'total_amount'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

     protected static function booted()
    {
        static::created(function ($orderItem) {
            $productId = $orderItem->product_id;
            $quantityTerjual = $orderItem->quantity;

            $stock = \App\Models\Stock::where('product_id', $productId)->latest()->first();

            $cogs = \App\Models\COGS::firstOrNew([
                'product_id' => $productId,
                'transaction_date' => now()->startOfMonth(), 
            ]);

            $cogs->purchase_price = $stock->price ?? $orderItem->price;
            $cogs->quantity_sold += $quantityTerjual;
            $cogs->total_cost = $cogs->quantity_sold * $cogs->purchase_price;
            $cogs->monthly_cogs = $cogs->total_cost;
            $cogs->save();
        });
    }
}
