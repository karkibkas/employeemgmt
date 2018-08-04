@extends('layouts.app')
@section('content')
<div class="container-fluid">
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
        <div class="col s12 m12 l9">
            <div class="row">
                @forelse($products as $product)
                    @component('components.product',['product' => $product])
                    @endcomponent
                @empty
                    <h4 class="center grey-text text-darken-2">No Products to Display!</h4>
                @endforelse
            </div>
            <br><br>
            <div class="center-align">
                {{$products->appends(request()->query())->links('vendor.pagination.default',['items' => $products])}}
            </div>
        </div>
        <div class="col s12 m3">
            <ul class="collection with-header">
                <li class="collection-header">
                    <h5 class="center">Categories</h5>
                </li>
                @forelse($categories as $category)
                    <a href="{{route('products',['category' => $category->slug])}}" class="collection-item grey-text">
                        <p>{{$category->title}}</p>
                    </a>
                @empty
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection