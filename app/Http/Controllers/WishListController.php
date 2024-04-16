<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{

    public function index()
    {
        $wishlistItems = Cart::instance('wishlist')->content();
        return view('wishlist.index',['wishlistItems'=>$wishlistItems]);
    }

    public function create(Request $request)
    {
        $product = Product::findorfail($request->id);
        $price = $product->sale_price ? $product->sale_price : $product->regular_price;

        Cart::instance('wishlist')->add($product->id,$product->name,1,$price)->associate('App\Models\Product');
        //return response()->json(['status'=>200,'message','Success ! Item has been added successfully']);
        $this->store();
        return redirect()->back()->with('message','Success ! Item has been added successfully');
    }
    public function update(Request $request)
    {
        $item = Cart::instance('wishlist')->get($request->rowId);
        Cart::instance('wishlist')->remove($request->rowId);
        Cart::instance('cart')->add($item->model->id,$item->model->name,1,$item->model->regular_price)->associate('App\Models\Product');
        $this->store();
        return to_route('wishlist.index');
    }
    public function delete($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        $this->store();
        return to_route('wishlist.index');
    }

    public function destroy()
    {
        Cart::instance('wishlist')->destroy();
        $this->store();
        return to_route('wishlist.index');
    }

    public function store()
    {
        if(Auth::check()){
            Cart::instance('wishlist')->store(Auth::user()->id);
        }
    }
}
