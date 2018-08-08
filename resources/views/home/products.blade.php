@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <h4 class="center">
        @isset($title)
            {{$title}}
        @else
            Our Latest Products
        @endisset
    </h4>
    <br>
    <div class="row">
        <div class="div col s12 m6 l5 offset-l2 xl4 offset-xl4">
            <form action="{{route('products')}}" id="sort-form">
                <input type="hidden" name="items_per_page" value="{{request()->items_per_page}}">
                <input type="hidden" name="category" value="{{request()->category}}">
                <div class="input-field">
                    <select name="sort_by" id="sort-option">
                    <option value="" disabled selected>Choose your option</option>
                    <option value="latest" {{request()->sort_by == 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="name" {{request()->sort_by == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="high-to-low" {{request()->sort_by == 'high-to-low' ? 'selected' : '' }}>Price | High to Low</option>
                    <option value="low-to-high" {{request()->sort_by == 'low-to-high' ? 'selected' : '' }}>Price | Low to High</option>
                    </select>
                    <label>Sort by:</label>
                </div>
            </form>
        </div>
        <div class="div col s12 m6 l5 xl4">
            <form action="{{route('products')}}" id="items-form">
                <input type="hidden" name="sort_by" value="{{request()->sort_by}}">
                <input type="hidden" name="category" value="{{request()->category}}">
                <div class="input-field">
                    <select name="items_per_page" id="items-option">
                    <option value="" disabled selected>Choose your option</option>
                    <option value="10" {{request()->items_per_page == '10' ? 'selected' : '' }}>10 Products</option>
                    <option value="15" {{request()->items_per_page == '15' ? 'selected' : '' }}>15 Products</option>
                    <option value="25" {{request()->items_per_page == '25' ? 'selected' : '' }}>25 Products</option>
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
                <div class="col s12 m6 l4 xl3">
                    @component('components.product',['product' => $product])
                    @endcomponent
                </div>
                @empty
                    <h4 class="center grey-text text-darken-2">No Products to Display!</h4>
                @endforelse
            </div>
            <br><br>
            <div class="center-align">
                {{$products->appends(request()->query())->links('vendor.pagination.default',['items' => $products])}}
            </div>
        </div>
        <div class="col s12 m6 offset-m3 xl3">
            <ul class="collection with-header">
                <li class="collection-header">
                    <h5 class="center">Categories</h5>
                </li>
                @forelse($categories as $category)
                    <a href="{{route('products',
                            [
                                'category' => $category->slug,
                                'sort_by' => request()->sort_by,
                                'items_per_page' => request()->items_per_page
                            ]
                        )}}" class="collection-item grey-text text-uppercase">
                        {{$category->title}}
                    </a>
                @empty
                    <a href="#" class="collection-item">No Categories yet!</a>
                @endforelse
                <a href="{{route('products',
                        [
                            'category' => 'all',
                            'sort_by' => request()->sort_by,
                            'items_per_page' => request()->items_per_page
                        ]
                    )}}" class="collection-item grey-text text-uppercase">
                    All
                </a>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#sort-option').on('property change',function(){
            $('#sort-form').submit();
        });
        $('#items-option').on('property change',function(){
            $('#items-form').submit();
        });
    </script>
@endsection