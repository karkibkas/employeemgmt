@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <h4 class="center grey-text text-darken-1">Products Page</h4>
    <br><br>
    <div class="row">
        <div class="div col s12 m6 l5 offset-l2 xl4 offset-xl4">
            <form action="#" method="get">
                <div class="input-field">
                    <select>
                    <option value="" disabled selected>Choose your option</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                    </select>
                    <label>Sort by:</label>
                </div>
            </form>
        </div>
        <div class="div col s12 m6 l5 xl4">
            <form action="#" method="get">
                <div class="input-field">
                    <select>
                    <option value="" disabled selected>Choose your option</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                    </select>
                    <label>Items per page:</label>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        @foreach($products as $product)
            @component('components.product',['product' => $product])
            @endcomponent
        @endforeach
    </div>
    <br><br>
    <div class="center-align">
        {{$products->links('vendor.pagination.default',['items' => $products])}}
    </div>
</div>
@endsection