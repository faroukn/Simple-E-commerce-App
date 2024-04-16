@extends('layouts.admin')

@section('title')
    Admin
@endsection

@push('styles')
@endpush

@section('content')
    @if($products->Count() > 0)
        <div class="container justify-content-center">
            <table class="table">
                <thead class="table-light text-center">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NAME</th>
                    <th scope="col">SLUG</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">CREATED AT</th>
                    <th scope="col">ACTION</th>
                </tr>
                </thead>
                <tbody class="table-group-divider text-center">
                @foreach($products as $product)
                    <tr>

                        <th scope="row" class="py-3" >
                            {{$product->slug}}
                        </th>
                        <th scope="row" class="py-3" >
                            {{$product->name}}
                        </th>
                        <th scope="row" class="py-3" >
                            <a href="{{route('shop.product.details',$product->slug)}}">{{$product->slug}}</a>
                        </th>

                        <th scope="row" class="py-3" >
                            ${{$product->regular_price}}
                        </th>

                        <th scope="row" class="py-3" >
                            {{$product->quantity}}
                        </th>

                        <th scope="row" class="py-3" >
                            {{$product->stock_status}}
                        </th>

                        <th scope="row" class="py-3" >
                            {{$product->created_at}}
                        </th>

                        <th scope="row" class="py-3" >
                            @if($product->stock_status == "ordered")
                                <form action="#" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger">
                                        <i class="fa fa-remove"> Cancel </i>
                                    </button>
                                </form>
                                <form action="#" method="post" style="display:inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-outline-info">
                                        <i class="fa fa-remove"> Delivered </i>
                                    </button>
                                </form>
                            @endif

                        </th>

                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>There is No Orders</h2>
                    </div>
    @endif
@endsection
