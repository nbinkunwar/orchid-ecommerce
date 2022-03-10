<?php
namespace App\Http\Services;

use App\Models\Cart;

class CartService
{
    protected $cart;
    
    public function make($identifier)
    {
        $cart = Cart::where('identifier',$identifier)->first();
        if(!$cart)
        {
            $cart = new Cart();
            $cart->fill(['identifier'=>$identifier,'user_id'=>auth()->user()->id])->save();
        }
        $this->cart = $cart;
    }

    public function getItems()
    {

    }

    public function addItem($productId, $quantity, $price, $attributes = [])
    {
        $cartItems = $this->cart->cart_items??[];
        $product = $cartItems->where('id',$productId)->first();
        $quantity = $product->quantity+$quantity;

    }
}