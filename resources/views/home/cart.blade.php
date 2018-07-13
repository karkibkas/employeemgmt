@extends('layouts.app')
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
                                <tr data-id="{{$product->id}}">
                                    <td>{{$loop->index + 1}}</td>
                                    <td>
                                        <div>
                                            <img src="{{('storage/products/'.App\Product::where('slug' , $product->id)->first()->image)}}" width="50px"  height="50px"  alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{route('product-details',$product->id)}}">{{$product->name}}</a>
                                    </td>
                                    <td class="val">${{$product->price}}</td>
                                    <td>
                                        <form action="{{route('cart.index')}}" method="post">
                                            @csrf
                                            <div class="row"  style="margin-bottom:0 !important">
                                                <input type="hidden" id="rowId-{{$product->id}}" value="{{$product->rowId}}">
                                                <div class="input-field col s9 xl5">
                                                    <select name="qty" id="qty-{{$product->id}}">
                                                        <option value="0">None</option>
                                                        @for($i = 0; $i < App\Product::where('slug' , $product->id)->first()->quantity; $i++)
                                                            <option value="{{$i+1}}" {{$product->qty == ($i+1) ? 'selected' : '' }}>{{$i + 1}}</option>
                                                        @endfor
                                                    </select>
                                                    <label>Quantity</label>
                                                </div>
                                                <div class="col">
                                                <br>
                                                <button type="submit" id="update-cart" data-id="{{$product->id}}" class="btn-floating waves-effect bg2 tooltipped" data-position="bottom" data-tooltip="Update quantity">
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
            <ul class=" collection with-header">
                <li class="collection-header grey-text text-darken-2">
                    <h5 class="center">Cart Summary</h5>
                </li>
                <li class="collection-item grey lighten-4">Subtotal:
                    <span class="secondary-content blue-text val cart-subtotal">${{Cart::subtotal()}} /-</span>
                </li>
                <li class="collection-item grey lighten-4">Shipping:
                    <span class="secondary-content blue-text val cart-tax">${{Cart::tax()}} /-</span>
                </li>
                <li class="collection-item light-green lighten-4">Total:
                    <span class="secondary-content grey-text text-darken-3 val cart-total">${{Cart::total()}} /-</span>
                </li>
                <li class="collection-item center">
                    <a class="btn waves-effect waves-light green lighten-1 checkout-btn {{!Cart::count() ? 'disabled': ''}}" href="{{route('checkout')}}">check out</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection