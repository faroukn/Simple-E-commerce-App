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
    </style>
@endpush
@section('content')
    @if($wishlistItems->Count() > 0)
        <div class="container justify-content-center">
            <table class="table">
                <thead class="table-light text-center">
                <tr>
                    <th scope="col">IMAGE</th>
                    <th scope="col">PRODUCT NAME</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">TOTAL</th>
                    <th scope="col">ACTION</th>
                </tr>
                </thead>
                <tbody class="table-group-divider text-center">
                @foreach($wishlistItems as $item)
                    <tr>
                        <th scope="row" class="py-3" >
                            <a href="{{route('shop.product.details',['slug'=>$item->model->slug])}}"><img class="fixed-width-images" src="{{asset($item->model->image)}}" /></a>
                        </th>
                        <th scope="row" class="py-5" >{{$item->model->name}}</th>
                        <th scope="row" class="py-5" >
                            <p style="color: #842029">
                                {{$item->price }}
                            </p>
                        </th>

                        <th scope="row" class="py-5" >
                            {{$item->subtotal() }}
                        </th>
                        <th scope="row" class="py-5" >
                            <div style="display: inline-block">

                                <form action="{{route('wishlist.update')}}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>

                                    <input type="hidden" name="rowId" value="{{$item->rowId}}">
                                </form>

                            <form action="{{route('wishlist.delete',$item->rowId)}}" method="post" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn">
                                    <i class="fa fa-remove"></i>
                                </button>
                            </form>


                            </div>
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
                <form action="{{route('wishlist.destroy')}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger mt-5">
                        <i class="fa fa-remove"></i>
                        Clear All Items
                    </button>
                </form>
            </div>
        </div>

    @else
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Your WishList Is Empty</h2>
                <h5 class="mt-3"> Add It Now </h5>
                <a href="{{route('shop.index')}}" class="btn btn-warning mt-5">
                    Shop Now
                </a>
            </div>
        </div>
    @endif
@endsection
