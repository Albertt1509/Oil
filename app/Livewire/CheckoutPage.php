<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Address;
use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Title;
use Stripe\Stripe;
use Stripe\Checkout\Session;

#[Title('Checkout')]
class CheckoutPage extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $zip_code;
    public $payment_method;

    public function placeorder(){
        $this->validate(
            [
                'first_name' =>'required',
                'last_name' =>'required',
                'phone' =>'required',
                'street_address' =>'required',
                'zip_code' =>'required',
                'payment_method' =>'required',
            ]
        );
        $cart_items = CartManagement::getCartItemsCookie();
        $line_items=[];

        foreach($cart_items as $item){
            $line_items[]=[
                'price_data'=>[
                    'currency'=> 'inr',
                    'unit_amount'=> $item['unit_amount'] * 100,
                    'product_data'=> [
                        'name'=>$item['name']
                    ]
                ],
                'quantity'=>$item['name'],
            ];
        }
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->grand_total =CartManagement::calculateGrandTotal($cart_items);
        $order->payment_method=$this->payment_method;
        $order->status='new';
        $order->currency='IDR';
        $order->shipping_amount=0;
        $order->shipping_method='none';
        $order->notes='Order Place by ' .auth()->user()->name;
        $address = new Address();
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->street_address = $this->street_address;
        $address->zip_code = $this->zip_code;

        $redirec_url='';

        if($this->payment_method=='stipe'){
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $sessionCheckout=Session::create([
                'payment_method_types'=>['card'],
                'customer_email'=>auth()->user()->email,
                'customer_email'=>$line_items,
                'mode'=>'payment',
                'success_url'=>route('success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel'=>route('cancel'),
            ]);
            $redirec_url=$sessionCheckout->url;
        }else{
            $redirec_url=route('success');
        }

        $order->save();
        $address->order_id = $order->id;
        $address->save();

        $order->items()->createMany($cart_items);
        CartManagement::clearCartItems();
        return redirect($redirec_url);
        
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        return view('livewire.checkout-page',[
            'cart_items' => $cart_items,
            'grand_total' => $grand_total 
        ]);
    }
}
