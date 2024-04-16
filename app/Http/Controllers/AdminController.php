<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users_count = User::all()->count();
        $orders_count = Order::all()->count();
        $products_count = Product::all()->count();
        return view('admin.index',['cur'=>0,'users_count'=>$users_count,'orders_count'=>$orders_count,'products_count'=>$products_count]);
    }
    public function usersIndex()
    {
        $users = User::where('id','!=',Auth::user()->id)->get();
        return view('admin.users.index',['cur'=>1,'users'=>$users]);

    }
    public function userShow(User $userId)
    {
        $orders = $userId->orders()->get();
        return view('admin.users.show',['cur'=>1,'orders'=>$orders]);

    }

    public function ordersIndex()
    {
        $orders = Order::all();
        return view('admin.orders.index',['cur'=>2,'orders'=>$orders]);
    }

    public function orderShow(Order $order)
    {
        $orderItems = $order->orderitems()->get();
        return view('admin.orders.show',['cur'=>2,'items'=>$orderItems]);
    }

    public function orderDeliver(Order $order)
    {
        $order->update(['status'=>'delivered','canceled_data'=>Date('Y-m-d h:m:s')]);
        return to_route('admin.orders.index');
    }
    public function orderCancel($order)
    {
        $order->update(['status'=>'canceled','delivered_data'=>Date('Y-m-d h:m:s')]);
        return to_route('admin.orders.index');
    }

    public function productsIndex()
    {
        $products = Product::all();
        return view('admin.products.index',['cur'=>3,'products'=>$products]);

    }


}
