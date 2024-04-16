@extends('layouts.app')

@section('title')
    Cart Page
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
    @if($cartItems->Count() > 0)
    <div class="container justify-content-center">
        <table class="table">
            <thead class="table-light text-center">
            <tr>
                <th scope="col">IMAGE</th>
                <th scope="col">PRODUCT NAME</th>
                <th scope="col">PRICE</th>
                <th scope="col">QUANTITY</th>
                <th scope="col">TOTAL</th>
                <th scope="col">ACTION</th>
            </tr>
            </thead>
            <tbody class="table-group-divider text-center">
        @foreach($cartItems as $item)
            <tr>
                <th scope="row" class="py-3" >
                    <a href="{{route('shop.product.details',['slug'=>$item->model->slug])}}"><img class="fixed-width-images" src="{{asset($item->model->image)}}" /></a>
                </th>
                <th scope="row" class="py-5" >{{$item->model->name}}</th>
                <th scope="row" class="py-5" >
                    <p style="color: forestgreen">
                        ${{$item->price }}
                    </p>
                </th>
                <th scope="row" class="py-5">
                    <form action="{{route('cart.update')}}" method="post">
                        @csrf
                        @method('PUT')
                    <input type="hidden" name="rowId" value="{{$item->rowId}}"/>
                    <input type="number" class="form-control fixed-size-qunatity" value="{{$item->qty }}" name="quantity" onchange="submit()"/>

                    </form>
                </th>

                <th scope="row" class="py-5" >
                    ${{$item->subtotal() }}
                </th>
                <th scope="row" class="py-5" >
                    <form action="{{route('cart.delete',$item->rowId)}}" method="post">
                        @csrf
                        @method('DELETE')
                    <button class="btn">
                        <i class="fa fa-remove"></i>
                    </button>
                    </form>
                </th>

            </tr>
        @endforeach
            </tbody>
        </table>
        <a href="{{route('shop.index')}}" class="btn btn-warning mt-5">
            <i class="fa fa-arrow-left"></i>
            Continue Shopping
        </a>
        <div class="pull-right">
            <form action="{{route('cart.destroy')}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger mt-5">
                    <i class="fa fa-remove"></i>
                    Clear All Items
                </button>
            </form>

            <div>

                <div class="checkout_section">
                    <div class="brands_section">
                        <div class="form-label p-2 font-monospace" style="font-size: 1.5rem;background-color: white">
                            <h3>Cart Totals</h3>
                            <h6>Sub Total <span>${{Cart::instance('cart')->subtotal()}}</span></h6>
                            <h6>Tax <span>${{Cart::instance('cart')->tax()}}</span></h6>
                            <h6>Total <span>${{Cart::instance('cart')->total()}}</span></h6>
                        </div>

                    </div>

                    <div class="categories_section" style="margin-left: 15%">
                        <form action="{{route('order.payment')}}" method="GET">
                            @csrf
                        <button class="btn btn-warning p-2 font-monospace rounded-5">
                        <i class="fa fa-bank"></i>
                            Check Out
                        </button>
                        </form>
                    </div>
                    </div>

                    {{--                <div>--}}
                    {{--                            <label for="minPrice">Min Price:</label>--}}
                    {{--                            <input type="number" id="minPrice" class="form-control" min="0" step="0.1" value="0" style="width:20%">--}}

                    {{--                            <label for="maxPrice">Max Price:</label>--}}
                    {{--                            <input type="number" id="maxPrice" class="form-control" min="0" step="0.1" value="1000" style="width:20%">--}}

                    {{--                            <button type="button" class="btn btn-warning mt-1" style="width: 25%">Pricing</button>--}}
                    {{--                    </div>--}}
                </div>

            </div>
        </div>
    </div>

    @else
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Your Cart Is Empty</h2>
                <h5 class="mt-3"> Add It Now </h5>
                <a href="{{route('shop.index')}}" class="btn btn-warning mt-5">
                    Shop Now
                </a>
            </div>
        </div>
    @endif
@endsection
