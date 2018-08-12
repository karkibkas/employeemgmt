@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col s12 m12 xl8">
            <div class="card-panel cart-panel">
                @if(!Cart::count())
                    <h5 class="grey-text text-darken-2 center">Your cart is empty! <a href="{{route('products')}}"> Start Shopping</a></h5>
                @else
                    <table class="responsive-table cart-items">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(Cart::content() as $product)
                                <tr data-id="{{$product->model->slug}}">
                                    <td>{{$loop->index + 1}}</td>
                                    <td>
                                        <div>
                                            <img src="{{('storage/products/'.$product->model->image)}}" width="50px"  height="50px"  alt="{{$product->model->slug}}">
                                        </div>
                                    </td>
                                    <td>
                                        
                                        @if(!$product->model->hasStock($product->qty))
                                            <a class="tooltipped red-text" data-position="bottom" data-tooltip="This item has insufficient stock!" href="{{route('product-details',$product->model->slug)}}">{{$product->name}}</a>
                                        @else
                                            <a href="{{route('product-details',$product->model->slug)}}">{{$product->name}}</a>
                                        @endif
                                    </td>
                                    <td class="val">${{$product->price}}</td>
                                    <td>
                                        <form action="{{route('cart.index')}}" method="post">
                                            @csrf
                                            <div class="row"  style="margin-bottom:0 !important">
                                                <input type="hidden" id="rowId-{{$product->model->slug}}" value="{{$product->rowId}}">
                                                <div class="input-field col s9 xl5">
                                                    <select name="qty" id="qty-{{$product->model->slug}}">
                                                        <option value="0">None</option>
                                                        @for($i = 0; $i < $product->model->quantity; $i++)
                                                            <option value="{{$i+1}}" {{$product->qty == ($i+1) ? 'selected' : '' }}>{{$i + 1}}</option>
                                                        @endfor
                                                    </select>
                                                    <label>Quantity</label>
                                                </div>
                                                <div class="col">
                                                <br>
                                                <button type="submit" data-id="{{$product->model->slug}}" class="btn-floating waves-effect bg2 tooltipped update-cart" data-position="bottom" data-tooltip="Update quantity">
                                                    <i class="material-icons">sync</i>
                                                </button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>        
                @endif
            </div>
            <br><br>
        </div>
        <div class="col s12 m12 xl4">
            <div class="card-panel">
                @component('components.cart-summary')
                @endcomponent
                <br>
                <a class="btn waves-effect waves-light green lighten-1 checkout-btn {{!Cart::count() ? 'disabled': ''}}" href="{{route('checkout')}}">check out</a>
            </div>
        </div>
    </div>
</div>
@endsection