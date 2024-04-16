@extends('layouts.admin')

@section('title')
    Admin
@endsection

@push('styles')
    <style>
        .sp_border1{
            border:hidden;
            background-color: lawngreen;
            padding: 20px;
        }
        .sp_border2{
            border:hidden;
            background-color: orange;
            padding: 20px;
        }
        .sp_border3{
            border:hidden;
            background-color: dodgerblue;
            padding: 20px;
        }
    </style>
@endpush
@section('content')
    <div style="display: inline-block">
        <div class="sp_border1" style="display: inline-block">
            <p style="font-size: 40px;display: inline-block">{{$users_count}} Users</p>

            <li class="fa fa-user-circle pull-right" style="font-size: 80px;color:white;display: inline-block;margin-left: 200px">


        </div>

        <div class="sp_border2" style="display: inline-block">
            <p style="font-size: 40px;display: inline-block">{{$products_count}} Products</p>

            <li class="fa fa-product-hunt pull-right" style="font-size: 80px;color:white;display: inline-block;margin-left: 200px">


        </div>

        <div class="sp_border3" style="display: inline-block">
            <p style="font-size: 40px;display: inline-block">{{$orders_count}} Orders</p>

            <li class="fa fa-file pull-right" style="font-size: 80px;color:white;display: inline-block;margin-left: 200px">


        </div>

    </div>

    <div class="">

    </div>
@endsection
