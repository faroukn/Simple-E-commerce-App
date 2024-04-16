@extends('layouts.app')

@section('title')
    Shop
@endsection
@push('styles')
    <style>
        .page_selection{
            margin-top: 10px;
            margin-left: 50%;
        }

        .filter_section{
            border: hidden;
            margin: 10px;
            padding: 10px;
            background-color:#d1e7dd;

        }
    </style>
@endpush
@section('content')

    <div class="row align-items-start">
        <div class="col-3">
            <div class="filter_section">
                <div class="brands_section">
                    <p class="form-label p-2 font-monospace" style="font-size: 1.5rem;background-color: white">Brands</p>
                    @foreach($brands as $brand)
                        <div class="form-check" >
                                <input class="form-check-input" onchange="filterByBrands(this)" name="brands" value="{{$brand->id}}" @if(in_array($brand->id,explode(',',$q_brands))) checked="checked" @endif type="checkbox"/>
                                <label class="form-check-label" > {{$brand->name}} </label>
                                <p style="display: inline-block;color:lightslategrey">({{$brand->products->count()}})</p>
                        </div>
                    @endforeach
                </div>

                <div class="categories_section">
                    <p class="form-label p-2 font-monospace" style="font-size: 1.5rem;background-color: white">Categories</p>
                    @foreach($categories as $category)
                        <div class="form-check" >
                                <input class="form-check-input" onchange="filterByCategories(this)" name="categories" value="{{$category->id}}" @if(in_array($category->id,explode(',',$q_categories))) checked="checked" @endif type="checkbox"/>
                                <label class="form-check-label" > {{$category->name}} </label>
                                <p style="display: inline-block;color:lightslategrey">({{$category->products->count()}})</p>
                        </div>
                    @endforeach
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

        <div class="col">
    <div style="display: inline-block;margin:10px">

            <select name="orderby" onchange="productSort(this)" class="btn pty-4 border-black" style="display: inline-block;padding: 4px;">
                <option value="1" {{$order == 1 ? 'selected' : ''}}>Date, New To Old </option>
                <option value="2"  {{$order == 2 ? 'selected' : ''}}>Date, Old To New </option>
                <option value="3" {{$order == 3 ? 'selected' : ''}}>Price, Low To High</option>
                <option value="4" {{$order == 4 ? 'selected' : ''}}>Price, High To Low </option>
            </select>

            <select name="size" onchange="pageCustom(this)" class="btn pty-4 border-black" style="display: inline-block;padding: 4px;">
                <option value="12" {{$size == 12 ? 'selected' : ''}}>12 Product Per Page </option>
                <option value="24"  {{$size == 24 ? 'selected' : ''}}>24 Product Per Page </option>
                <option value="52" {{$size == 52 ? 'selected' : ''}}>52 Product Per Page </option>
                <option value="100" {{$size == 100 ? 'selected' : ''}}>100 Product Per Page </option>
            </select>

    </div>
        <div class="row row-cols-1 row-cols-md-4 g-4">
@foreach($products as $product)

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
                        <form action="{{ route('cart.store')}}" method="post">
                            @csrf

                            <button type="submit" class="btn btn-warning mt-3">
                                <i class="fa fa-shopping-cart"></i>
                                <i class="fa fa-plus"></i>
                                </button>
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <input type="hidden" name="quantity" id="qty" value="1">
                        </form>

                        <form action="{{ route('wishlist.store')}}" method="post">
                            @csrf

                            <button type="submit" class="btn btn-outline-danger mt-3">
                                <i class="fa fa-heart"></i>
                                <i class="fa fa-plus"></i>
                            </button>
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <input type="hidden" name="quantity" id="qty" value="1">
                        </form>

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

    {{$products->links('pagination.defulte')}}

    <form id="formFilter" action="{{route('shop.index')}}" method="GET" >
        @csrf

        <input type="hidden" id="id_page" value="{{$page}}" name="page" />
        <input type="hidden" id="id_size" value="{{$size}}" name="size" />
        <input type="hidden" id="id_orderby" value="{{$order}}" name="orderby" />
        <input type="hidden" id="id_brands"  value="{{$q_brands}}" name="brands" />
        <input type="hidden" id="id_categories"  value="{{$q_categories}}" name="categories" />
{{--        <input type="hidden" id="id_prange"  value="" name="prange" />--}}

    </form>
@endsection

@push('scripts')
    <script>
        let formf = document.getElementById('formFilter');

        function pageCustom(thumb){
            formf.children.id_size.value = thumb.value;
            formf.submit();
        }
        function productSort(thumb){
            formf.children.id_orderby.value = thumb.value;
            formf.submit();
        }

        function filterByBrands(thumb){
            let brands=formf.children.id_brands;
            if(thumb.checked && !checkWord(brands.value,thumb.brands)){
                if(brands.value == "") {
                    brands.value = thumb.value
                }else{
                    brands.value += ','+thumb.value
                }
            }if(!thumb.checked ){
                brands.value = stripWord(brands.value,thumb.value);
            }
            formf.submit();
        }

        function filterByCategories(thumb){
            let categories=formf.children.id_categories;
            if(thumb.checked && !checkWord(categories.value,thumb.categories)){
                if(categories.value == "") {
                    categories.value = thumb.value
                }else{
                    categories.value += ','+thumb.value
                }
            }if(!thumb.checked ){
                categories.value = stripWord(categories.value,thumb.value);
            }
            formf.submit();
        }
        function filterByPrice(thumb){
            let prange=formf.children.id_prange;
            if(thumb.checked && !checkWord(c.value,thumb)){
                if(prange.value == "") {
                    prange.value = thumb.value
                }else{
                    prange.value += ','+thumb.value
                }
            }if(!thumb.checked ){
                prange.value = stripWord(prange.value,thumb.value);
            }
            formf.submit();
        }

        function checkWord(text,target){
                return text.split(',').includes(target);
        }
        function stripWord(text, wordToStrip) {
            let new_text =  text.split(',');
            if(checkWord(text,wordToStrip)) {
                new_text.splice(new_text.indexOf(wordToStrip),1);
                return new_text.join(',');
            }
            //return text.replace(new RegExp(wordToStrip, 'gi'), "");
            return text;
        }
    </script>
@endpush
