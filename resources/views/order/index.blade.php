@extends('layouts.app')

@section('title')
    My Orders
@endsection

@section('content')
    @if($orders->Count() > 0)
        <div class="container justify-content-center">
            <table class="table">
                <thead class="table-light text-center">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NAME</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">ORDERED AT</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">ACTION</th>
                </tr>
                </thead>
                <tbody class="table-group-divider text-center">
                @foreach($orders as $order)
                    <tr>

                        <th scope="row" class="py-3" >
                            <a href="{{route('order.show',$order->id)}}">{{$order->id}}</a>
                        </th>
                        <th scope="row" class="py-3" >
                            <a href="{{route('order.show',$order->id)}}"> Preview ....</a>
                        </th>
                        <th scope="row" class="py-3" >
                            <p style="color: forestgreen">
                                ${{$order->total}}
                            </p>
                        </th>

                        <th scope="row" class="py-3" >
                            {{$order->created_at}}
                        </th>

                        <th scope="row" class="py-3">
                                <p>{{$order->status}}</p>
                        </th>

                        <th scope="row" class="py-3" >
                            @if($order->status == "ordered")
                                <form action="{{route('order.delete',$order->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger">
                                        <i class="fa fa-remove"> Cancel </i>
                                    </button>
                                </form>
                            @endif
                        </th>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <a href="{{route('shop.index')}}" class="btn btn-warning mt-5">
                <i class="fa fa-arrow-left"></i>
                Continue Shopping
            </a>
            @else
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>You Don't Orderd Yet</h2>
                        <h5 class="mt-3"> Order Now </h5>
                        <a href="{{route('shop.index')}}" class="btn btn-warning mt-5">
                            Shop Now
                        </a>
                    </div>
    @endif
@endsection
