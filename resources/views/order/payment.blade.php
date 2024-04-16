@extends('layouts.app')

@section('title')
    Payment
@endsection

@push('styles')
    <style>
        .main_content{
            text-align: center;
            align-content: center;
        }
        .payment_section{
            margin:auto;
            margin-top: 5%;
            border:hidden;
            width: 25%;
        }
        .top_section{
            background-color: #ffcd39;
            border-radius: 10px 10px 1px 1px;
            padding: 3px;
        }
        .bottom_section{
            margin: auto;
            /*margin-top:10%;*/
            background-color: #323539;
            border-radius: 1px 1px 10px 10px;
            padding: 2px;
        }

        .body_section{
            border-left:solid ;
            border-left-color: lightgrey;
            border-right:solid ;
            border-right-color: lightgrey;
        }
    </style>
@endpush
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="payment_section">
        <div class="top_section">
            <h3>Payment for Chek ${{Cart::instance('cart')->total}}</h3>
        </div>
    <div class="body_section">
    <br/>
        <h5> Pay With : </h5>
        <form action="{{route('order.create')}}" method="POST">
            @csrf
            <div class="form-group">
                <input type="radio" id="paypal" name="pgate" value="paypal" required>
                <label for="paypal" style="font-size: 30px;font-style: italic"><i class="fa fa-paypal m-1" style="color:blue;font-size: 20px"></i>PayPal</label>
            </div>

            <div class="form-group">
                <input type="radio" id="cash" name="pgate" value="cash" required>
                <label for="cash" style="font-size: 30px;font-style: italic"><i class="fa fa-money m-2" style="color:green;font-size: 20px"></i>Cash</label>
            </div>

            <div class="form-group">
                <input type="text"  name="country" placeholder="country" required>

            </div>

            <div class="form-group">
                <input type="text"  name="city" placeholder="city" required>

            </div>

            <div class="form-group mb-1">
                <input type="text"  name="address" placeholder="address" required>

            </div>


        <div class="bottom_section">
            <button type='submit' class="btn" style="color:white;font-size: 30px"> Pay Now </button>
        </div>

    </form>
    </div>
@endsection
