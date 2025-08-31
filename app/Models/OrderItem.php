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
        $stock = \App\Models\Stock::where('product_id', $orderItem->product_id)->first();

        if ($stock) {
            // Update stock (isGoing & totalonHand)
            $sold = OrderItem::where('product_id', $orderItem->product_id)->sum('quantity');
            $stock->isGoing     = $sold;
            $stock->totalonHand = $stock->onHand - $sold;
            $stock->save();

            // Hitung total cost
            $totalCost = $orderItem->quantity * $stock->price;

            // Replace data COGS (update kalau sudah ada)
            \App\Models\COGS::updateOrCreate(
                [
                    'product_id' => $orderItem->product_id,  
                    'transaction_date' => now()->toDateString(), 
                ],
                [ 
                    'quantity_sold'  => $sold, // total semua terjual
                    'total_selling'  => $sold * $stock->price,
                    'profit_per_unit'=> 0, // bisa hitung sesuai kebutuhan
                ]
            );
        }
    });
}

}
