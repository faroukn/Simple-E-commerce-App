@extends('layouts.admin')

@section('title')
    Admin
@endsection

@push('styles')
@endpush

@section('content')
    @if($users->Count() > 0)
        <div class="container justify-content-center">
            <table class="table">
                <thead class="table-light text-center">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NAME</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">CREATED AT</th>
                    <th scope="col">ORDERS</th>
                    <th scope="col">ACTION</th>
                </tr>
                </thead>
                <tbody class="table-group-divider text-center">
                @foreach($users as $user)
                    <tr>

                        <th scope="row" class="py-3" >
                            {{$user->id}}
                        </th>

                        <th scope="row" class="py-3" >
                            {{$user->name}}
                        </th>

                        <th scope="row" class="py-3" >
                            {{$user->email}}
                        </th>

                        <th scope="row" class="py-3" >
                            {{$user->created_at}}
                        </th>
                        <th scope="row" class="py-3" >
                            <a href="{{route('admin.users.show',$user->id)}}"> Preview ....</a>
                        </th>
                        <th scope="row" class="py-3" >
{{--                            @if($order->status == "ordered")--}}
{{--                                <form action="{{route('order.delete',$order->id)}}" method="post">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button class="btn btn-outline-danger">--}}
{{--                                        <i class="fa fa-remove"> Cancel </i>--}}
{{--                                    </button>--}}
{{--                                </form>--}}
{{--                            @endif--}}
                        </th>

                    </tr>
                @endforeach
                </tbody>
            </table>

            @else
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>There Is no users</h2>
                    </div>
    @endif
@endsection
