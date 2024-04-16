@extends('layouts.app')

@section('title')
    Order
@endsection
@push('styles')
<style>

    .fixed-width-images {
        width: 80px; /* or any desired width */
    }

    .fixed-size-qunatity{
        width: 70px;
        margin: auto;
    }

    .checkout_section{
        border: hidden;
        margin: 10px;
        padding: 10px;
        background-color:#a0aec0;

    }

</style>
@endpush
@section('content')
        <div class="container justify-content-center">
            <table class="table">
                <thead class="table-light text-center">
                <tr>
                    <th scope="col">IMAGE</th>
                    <th scope="col">PRODUCT NAME</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">QUANTITY</th>
                </tr>
                </thead>
                <tbody class="table-group-divider text-center">
                @foreach($items as $item)
                    <tr>
                        <th scope="row" class="py-3" >
                            <a href="{{route('shop.product.details',['slug'=>$item->product->slug])}}"><img class="fixed-width-images" src="{{asset($item->product->image)}}" /></a>
                        </th>
                        <th scope="row" class="py-5" >{{$item->product->name}}</th>
                        <th scope="row" class="py-5" >
                            <p style="color: forestgreen">
                                ${{$item->product->regular_price }}
                            </p>
                        </th>
                        <th scope="row" class="py-5">
                            <p >
                                {{$item->quantity }}
                            </p>
                        </th>


                    </tr>
                @endforeach
                </tbody>
            </table>
            <a href="{{route('order.index')}}" class="btn btn-warning mt-5">
                <i class="fa fa-arrow-left"></i>
                Back To Orders
            </a>
        </div>
@endsection
