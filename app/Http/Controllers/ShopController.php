<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page');
        $size = $request->query('size');
        $order= $request->query('orderby');

        is_numeric($page) && $page ? $page : $page=1;
        is_numeric($size) && $size ? $size : $size=12;
        is_numeric($order) && $order ? $order : $order=1;

        $o_column="";
        $o_order="";

        switch ($order)
        {
            case 2:
                $o_column = "created_at";
                $o_order = "ASC";
                break;
            case 3:
                $o_column = "regular_price";
                $o_order = "ASC";
                break;
            case 4:
                $o_column = "regular_price";
                $o_order = "DESC";
                break;
            default:
                $o_column = "created_at";
                $o_order = "DESC";
                break;
        }

        $brands = Brand::orderBy('name','ASC')->get();
        $q_brands = htmlspecialchars($request->query('brands')); // prevent sql injection
//        $q_brands = $request->query('brands'); //  sql injection
        $categories = Category::orderBy('name','ASC')->get();
        $q_categories = htmlspecialchars($request->query('categories'));
//        $prange = htmlspecialchars($request->query('prange'));
//        !$prange ? $prange='0,500' : $prange;
//        $from = explode(',',$prange)[0];
//        $to = explode(',',$prange)[1];

        $products = Product::where(function ($query) use ($q_brands){
            $query->whereIn('brand_id',explode(',',$q_brands))->orWhereRaw("'".$q_brands."'=''");
        })
            ->where(function ($query) use ($q_categories){
                $query->whereIn('category_id',explode(',',$q_categories))->orWhereRaw("'".$q_categories."'=''");
            })

            ->orderBy($o_column,$o_order)->paginate($size);

        return view('shop.index',['products'=>$products,'page'=>$page,'size'=>$size,'order' => $order,
            'brands' => $brands,'q_brands'=>$q_brands,'categories'=>$categories,'q_categories'=>$q_categories]);
    }

    public function productDetails($slug)
    {
        $product = Product::where('slug',$slug)->first();
        $rproducts = Product::where('slug','!=',$slug)->inRandomOrder('id')->get()->take(4);
        return view('shop.product.details',['product'=>$product,'rproducts' => $rproducts]);
    }
}
