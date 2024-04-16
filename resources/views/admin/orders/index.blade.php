@extends('layouts.admin')

@section('title')
    Admin
@endsection

@push('styles')
@endpush

@section('content')
    @if($orders->Count() > 0)
        <div class="container justify-content-center">
            <table class="table">
                <thead class="table-light text-center">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NAME</th>
                    <th scope="col">TOTAL PRICE</th>
                    <th scope="col">ORDERED AT</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">ACTION</th>
                </tr>
                </thead>
                <tbody class="table-group-divider text-center">
                @foreach($orders as $order)
                    <tr>

                        <th scope="row" class="py-3" >
                            <a href="{{route('admin.orders.show',$order->id)}}">{{$order->id}}</a>
                        </th>
                        <th scope="row" class="py-3" >
                            {{$order->name}}
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
                                <form action="{{route('admin.orders.delete',$order->id)}}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger">
                                        <i class="fa fa-remove"> Cancel </i>
                                    </button>
                                </form>
                                <form action="{{route('admin.orders.update',$order->id)}}" method="post" style="display:inline-block;">
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
