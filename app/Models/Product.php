<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
    'category_id',
    'brand_id',
    'name',
    'slug',
    'description',
    'images',
    'price',
    'is_active',
    'in_stock',
    'on_sale',
];
protected $casts=[
    'images'=>'array'
];
public function category(){
    return $this->belongsTo(Category::class);
    }

public function brand(){
    return $this->belongsTo(Brand::class);
    }
public function orderItems(){
    return $this->belongsTo(OrderItem::class);
    }
}