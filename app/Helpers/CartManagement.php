<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement{
    //add item to cart with qty
    static public function addItemsCart($product_id, $qty){
        $cart_items = self::getCartItemsCookie();

        $existing_item=null;
        foreach($cart_items as $key =>$items){
            if($items['product_id']== $product_id){
                $existing_item=$key;
                break;
            }
        }
        if($existing_item !==null){
            $cart_items[$existing_item]['quantity']++;
            $cart_items[$existing_item]['total_amount']= $cart_items[$existing_item];
            $cart_items[$existing_item]['unit_amount'];
        }else{
            $product = Product::where('id',$product_id)->first(['id','name','price','images']);
        if($product){
            $cart_items[]=[
                'product_id'=>$product_id,
                'name'=>$product->name,
                'image'=>$product->image,
                'quantity'=>1,
                'unit_amount'=>$product->price,
                'total_amount'=>$product->price,
            ];
        }
    }
    self::addCartItemToCookie($cart_items);
    return count($cart_items);

    }

    static public function removeCartItem($product_id){
        $cart_items=self::getCartItemsCookie();
        foreach($cart_items as $key => $item){
            if($item['product_id']== $product_id){
                unset($cart_items[$key]);
            }
        }
        self::addCartItemToCookie($cart_items);
        return $cart_items;
    }

    static public function incrementQuantityToCrtItem($product_id){
        $cart_items = self::getCartItemsCookie();

        foreach($cart_items as $key => $item){
            if($item['product_id']==$product_id){
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount']=$cart_items[$key]['quantity']*$cart_items[$key]['unit_amount'];
            }
        }
        self::addCartItemToCookie($cart_items);
        return $cart_items;
    }

    static public function decrementQuantityToCrtItem($product_id){
        $cart_items= self::getCartItemsCookie();
        foreach($cart_items as $key =>$item){
            if($item['product_id']==$product_id){
                if($cart_items[$key]['quantity'>1]){
                    $cart_items[$key]['total_amount']=$cart_items[$key]['quantity']* $cart_items[$key]['total_amount'];
                }
            }
        }
        self::addCartItemToCookie($cart_items);
        return $cart_items;
    }

    static public function calculateGrandTotal($items){
        return array_sum(array_column($items,'total_amount'));
    }

    static public function addCartItemToCookie($cart_items)
    {
        Cookie::queue('cart_items',json_encode($cart_items),60*24*30);
    }
    
    static public function clearCartItems(){
        Cookie::queue(Cookie::forget('carts_items'));
    }

    static public function getCartItemsCookie(){
        $cart_items = json_decode(Cookie::get('cart_items'),true);
        if(!$cart_items){
            $cart_items=[];
        }
        return $cart_items;
    }
}