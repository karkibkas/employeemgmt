@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <h4 class="grey-text text-darken-2 center">{{$product->title}}</h4>
        <br><br>
    <div class="col xl6">
        <ul class="collection">
            <li class="collection-item">
                <img src="{{asset('storage/products/'.$product->image)}}" class="materialboxed" alt="{{$product->title}}" height="250px" width="100%">
            </li>
            <li class="collection-item">
                <div class="row">
                    <div class="col s6 m4 l4 xl4">
                        <img src="{{asset('storage/products/'.$product->image)}}" alt="{{$product->title}}" class="materialboxed img-details">
                    </div>
                    <div class="col s6 m4 l4 xl4">
                        <img src="{{asset('storage/products/'.$product->image)}}" alt="{{$product->title}}" class="materialboxed img-details">
                    </div>
                    <div class="hide-on-small-only col s12 m4 l4 xl4">
                        <img src="{{asset('storage/products/'.$product->image)}}" alt="{{$product->title}}" class="materialboxed img-details">
                    </div>
                </div>
            </li>
            <li class="show-on-small hide-on-med-and-up collection-item">
                <img src="{{asset('storage/products/'.$product->image)}}" alt="{{$product->title}}" class="materialboxed img-details">
            </li>
        </ul>
    </div>
    <div class="col xl5 grey-text text-darken-2">
        <div class="card-panel">
            <div class="">
                <h5>{{$product->title}}</h5>
            </div>
            <div class="collection-item">
                <p>{{$product->description}}</p>
                <p><strong>Price:</strong> <span class="val grey-text text-darken-1">${{$product->price}}</span></p>
                <p>Available Quantity: <span class="val grey-text text-darken-1">{{$product->quantity}}</span></p>
                @if($product->hasLowStock())
                    <span class="chip yellow">Low Stock</span>
                    <br>
                @endif
                @if(!$product->outOfStock())
                    <form method="post">
                        @csrf
                        <div class="row"  style="margin-bottom:0 !important">
                            <div class="col">
                                <h6 class="mt-1">Quantity:</h6>
                            </div>
                            <div class="input-field col">
                                <select name="qty" id="qty">
                                    @for($i = 0; $i <= $product->quantity; $i++)
                                    <option value="1">{{$i+1}}</option>
                                    @endfor
                                </select>
                                <label>Quantity</label>
                            </div>
                        </div>
                    </form>
                    <div class="center">
                        <a href="#" id="add-cart" data-id="{{$product->id}}" class="btn bg2 waves-effect waves-light tooltipped" data-position="bottom" data-tooltip="Add to Cart"><i class="material-icons">add_shopping_cart</i></a>
                        <a href="#" class="btn bg2 waves-effect waves-light tooltipped" data-position="bottom" data-tooltip="Add to Wishlist"><i class="material-icons">favorite</i></a>
                    </div>
                @else
                    <span class="chip white-text red lighten-1">
                        Out Of Stock
                    </span>
                @endif
                <br><br>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection