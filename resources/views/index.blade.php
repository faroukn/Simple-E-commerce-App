@extends('layouts.app')

@section('title')
    Store App
@endsection

@push('styles')
    <style>

        .home_banner{
            margin-top: 3%;
            background-color: #0dcaf0;
            text-align: center;
        }
        .text_banner{
            background-color: red;
            color: #323539;
            font-size: 25px;
            padding: 10px;
            /*margin-top: -10px;*/
            text-transform: uppercase;
            transform: skewX(20deg);
            transition: transform .5s ease-in-out;
            border-radius: 10px;
            margin-bottom: 30%;
            /*transform: rotateZ(10deg);*/
            /*writing-mode: vertical-lr;*/
        }
        .text_banner:hover{
            transform: rotateZ(-10deg) scale(1.1,1.1);
            background-color:lightpink;
        }
        .products_section{
            margin-top: -1%;
            margin-bottom: 10%;
            text-align: center;
        }

        .img_sec{
            margin:auto;
            margin-top: 1%;
            transform: scale(1.5,1.3);
            text-align: center;
        }

        .fixed-width-images {
            width: 100px; /* or any desired width */

        }

        .img_spe{
            margin: 10px;

        }
    </style>
@endpush
@section('content')

    <div class="home_page bg-body-secondary">
        <div class="products_section">
            <div class="pull-left mt-5 mx-4">
                <h2 style="background-color: #ffcd39">Latest</h2>
                <h3>New</h3>
                <h4 style="background-color: #ef4444">Fashion</h4>
            </div>
            <img src="{{asset($products[0]->image)}}" id="mimage" class="img_sec mt-5" alt="1.jpg">
            <div class="pull-right mt-5 p-5">

                <div class="fixed-width-images m-1" >
                    <img src="{{asset($products[0]->image)}}" onclick="showImage(this)" alt="{{$products[0]->name}}" class="img-fluid img_spe" >
                    <img src="{{asset($products[1]->image)}}" onclick="showImage(this)" alt="{{$products[1]->name}}" class="img-fluid img_spe" >
                    <img src="{{asset($products[2]->image)}}" onclick="showImage(this)" alt="{{$products[2]->name}}" class="img-fluid img_spe" >
                </div>

            </div>
            <div class="pull-right mt-5 p-5">
                <h1 style="writing-mode: vertical-lr;color: #997404;font-size: 100px">Shop</h1>
            </div>


        </div>

        <div class="home_banner">
            <i class="fa fa-shopping-cart" style="font-size: 50px;color: #ffcd39">
                <br/>
                <button class="text_banner " onclick="window.location='{{route('shop.index')}}'">Shopping Now<i class="fa fa-arrow-right"></i></button>
            </i>
        </div>



    </div>
@endsection

@push('scripts')
    <script>
        function showImage(thumbnail) {
            const mainImage = document.getElementById('mimage');
            mainImage.src = thumbnail.src;
        }
    </script>
@endpush
