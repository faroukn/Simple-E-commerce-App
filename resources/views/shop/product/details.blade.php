@extends('layouts.app')

@section('title')
    {{$product->name}}
@endsection
@push('styles')
    <style>
        .fixed-width-image {
            width: 600px; /* or any desired width */

        }.fixed-width-images {
            width: 200px; /* or any desired width */

        }.fixed-width-div {
            margin-left: 60px;
            width: 1700px; /* or any desired width */

        }

    </style>
@endpush
@section('content')
        <div class="row align-items-start">
            <div class="col-2">
                @foreach(explode(',',$product->images) as $image)
                    <div class="fixed-width-images m-1" onclick="showImage(this)">
                        <img src="{{asset($image)}}" alt="{{$product->name}}" class="img-fluid" >
                    </div>
                @endforeach
            </div>
            <div class="col-4">
                <div class="fixed-width-image">
                    <img src="{{asset($product->image)}}" alt="{{$product->name}}" class="img-fluid" id="mimage">
                </div>


            </div>
            <div class="col">
                <main>
                    <div class="product-info">
                        <h1>{{$product->name}}</h1>
                            <p class="product-price">&#x20B9;{{ $product->regular_price }}</p>
                    </div>
                    <div class="product-description m-4">
                        <p>
                        {{$product->description}}
                        </p>
                    </div>

                    <div class="product-details">
                        <h2>Specifications</h2>

                        {{$product->featured}}<br/>

                     @if ($product->quantity > 0)
                        <span class="badge bg-success">In Stock</span>
                    @else
                        <span class="badge bg-danger">Out of Stock</span>
                @endif
                    </div>

                    <div class="product-options">
                        <p>Choose your size:</p>
                        <select>
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>

                    <div class="action-buttons mt-3">

                            <form action="{{route('cart.store')}}" method="POST">
                                @csrf
                                <button href="javascript:void(0)" class="btn btn-outline-warning">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <input type="hidden" name="quantity" id="qty" value="1">
                            </form>

                        <form action="{{ route('wishlist.store')}}" method="post">
                            @csrf

                            <button type="submit" class="btn btn-outline-danger mt-3">
                                <i class="fa fa-heart"></i>
                                Add to WishList
                            </button>
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <input type="hidden" name="quantity" id="qty" value="1">
                        </form>
                    </div>
                </main>
            </div>

        </div>

    <div class="row">
        <div class="col mt-5">
            <div class="fixed-width-div">
            <h2 style="margin:12px 12px 16px 12px; text-decoration-style: double">Customers Also Bought These</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach($rproducts as $product)

                    <div class="col">

                        <div class="card h-100">
                            <a href="{{route('shop.product.details',['slug'=>$product->slug])}}">   <img src="{{asset($product->image)}}" class="card-img-top img-fluid w-100 h-100" alt="{{$product->image}}">
                            </a>
                            <div class="card-body p-4">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                {{--                    <p class="card-text">{{ $product->short_description }}</p>--}}
                                <div class="d-flex align-items-center">
            <span class="text-warning">
                @for ($i = 0; $i < 3; $i++)
                    <i class="fa fa-star"></i>
                @endfor
                @for ($i = 3; $i < 5; $i++)
                    <i class="fa fa-star"></i>
                @endfor
            </span>
                                    <span class="ms-2 text-muted">(3 ratings)</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">&#x20B9;{{ $product->regular_price }}</span>
                                    <form action="{{ route('user.index', $product->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                                    </form>
                                    <a href="{{ route('user.index', $product->id) }}" class="btn btn-outline-light">
                                        <i class="fa fa-heart"></i> Wishlist</a>
                                </div> @if ($product->quantity > 0)
                                    <span class="badge bg-success">In Stock</span>
                                @else
                                    <span class="badge bg-danger">Out of Stock</span>
                                @endif

                                @if ($product->discount)
                                    <span class="badge bg-warning">Discount!</span>
                                @endif

                            </div>
                        </div>
                    </div>

                @endforeach
            </div >
        </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        function showImage(thumbnail) {
            const mainImage = document.getElementById('mimage');
            mainImage.src = thumbnail.querySelector('img').src;
        }
    </script>
@endpush
