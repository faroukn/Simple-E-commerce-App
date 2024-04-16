<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use App\Models\Transaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Auth::user()->orders()->get();
        return view('order.index',['orders'=>$orders]);
    }

    public function show($orderId)
    {
        $order = Auth::user()->orders()->findOrfail($orderId);
        $items = Auth::user()->orders()->findOrfail($orderId)->orderitems()->get();
        return view('order.show',['order'=>$order,'items'=>$items]);
    }

    public function create(Request $request)
    {
        $cartItems = Cart::instance('cart')->content();
        if($cartItems->Count() > 0){
            return view('order.payment');
        }else{
            return view('cart.index');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
           'pgate' => 'required|in:paypal,cash',
            'country' => 'required|min:3',
            'city' => 'required|min:3',
            'address' => 'required|min:10'
        ]);

        $cartItems = Cart::instance('cart')->content();
        $order = Order::create(['user_id'=>Auth::user()->id,'subtotal'=>Cart::instance('cart')->subtotal(),
            'tax'=>Cart::instance('cart')->tax(), 'total'=>Cart::instance('cart')->total(),
            'name'=>Auth::user()->name,'address'=>$request->address,
            'city'=>$request->city, 'country'=>$request->country,
            ]);

        foreach($cartItems as $item){
            $orderitem = new OrderItem;
            $orderitem->product_id = $item->model->id;
            $orderitem->price = $item->model->regular_price;
            $orderitem->quantity = $item->qty;
            $order->orderitems()->save($orderitem);
        }

        $shipping = new Shipping;
        $shipping->name =Auth::user()->name;
        $shipping->address =$request->address;
        $shipping->city = $request->city;
        $shipping->country = $request->country;
        $order->shipping()->save($shipping);

        $transaction = new Transaction;
        $transaction->user_id = Auth::user()->id;
        $transaction->mode = $request->pgate;
        $order->transaction()->save($transaction);

        Cart::instance('cart')->destroy();
        return to_route('order.index');
    }

    public function delete($orderId)
    {
        $order = Auth::user()->orders()->findOrfail($orderId);
        $order->update(['status'=>'canceled','canceled_data'=>Date('Y-m-d h:m:s')]);
        return to_route('order.index');
    }
}
