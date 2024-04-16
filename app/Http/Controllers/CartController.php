<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::instance('cart')->content();
        return view('cart.index',['cartItems'=>$cartItems]);
    }

    public function create(Request $request)
    {
        $product = Product::findorfail($request->id);
        $price = $product->sale_price ? $product->sale_price : $product->regular_price;
        Cart::instance('cart')->add($product->id,$product->name,$request->quantity,$price)->associate('App\Models\Product');
        $this->store();
        return redirect()->back()->with('message','Success ! Item has been added successfully');
    }

    public function update(Request $request)
    {
        Cart::instance('cart')->update($request->rowId,$request->quantity);
        $this->store();
        return to_route('cart.index');
    }

    public function delete($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->store();
        return to_route('cart.index');
    }

    public function destroy()
    {
        Cart::instance('cart')->destroy();
        $this->store();
        return to_route('cart.index');
    }

    public function store()
    {
        if(Auth::check()){
            Cart::instance('cart')->store(\Auth::user()->id);
        }
    }
}
