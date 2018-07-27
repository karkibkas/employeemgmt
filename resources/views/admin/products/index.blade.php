@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card-panel">
            <br>
            <h4 class="center grey-text text-darken-1">Products List</h4>
            <br>
            <table class="responsive-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>
                                <img width="50px" height="50px" src="{{asset('storage/products/'.$product->image)}}" alt="">
                            </td>
                            <td>{{$product->id}}</td>
                            <td>{{$product->title}}</td>
                            <td>{{$product->hasCategory->title}}</td>
                            <td class="center">{{$product->quantity}}</td>
                            <td>{{$product->created_at->diffForHumans()}}</td>
                            @if($product->updated_at)
                                <td>{{$product->updated_at->diffForHumans()}}</td>
                            @else
                                <td>Not updated</td>
                            @endif
                            <td>
                                <div class="center">
                                    <a href="{{route('admin.products.show',$product->id)}}" class="btn-floating btn-small waves-effect waves-light tooltipped" data-position="left" data-tooltip="Show Product Details">
                                        <i class="material-icons">description</i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <h4 class="center grey-text text-darken-2">No Products to Display!</h4>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <br><br>
            <div class="center-align">
                {{$products->links('vendor.pagination.default',[ 'items' => $products ])}}
            </div>
        </div>
    </div>
    <div class="fixed-action-btn">
        <a href="{{route('admin.products.create')}}" class="btn-floating btn-large waves-effect waves-light red">
            <i class="large material-icons">add</i>
        </a>
    </div>
</div>
@endsection