@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card-panel grey-text text-darken-1">
            <ul class="collection with-header">
                <li class="collection-header">
                    <h4 class="center">Product Details</h4>
                </li>
                <li class="collection-item">
                    <h5 class="center">{{$product->title}}</h5>
                </li>
                <li class="collection-item">
                    <div>
                        <img src="{{asset('storage/products/'.$product->image)}}" width="100%" height="320px" alt="">
                    </div>
                </li>
                <li class="collection-item">
                    <h5 class="center">Product Description</h5>
                    <p>{!! $product->description !!}</p>
                </li>
                <li class="collection-item">
                    <p>
                        <strong>Category: </strong>
                        <span>{{$product->hasCategory->title}}</span>
                    </p>
                    <p>
                        <strong>Price: </strong>
                        <span>${{$product->price}}</span>
                    </p>
                    <p>
                        <strong>Quantity: </strong>
                        <span>{{$product->quantity}}</span>
                    </p>
                </li>
                <li class="collection-item">
                    <div class="row">
                        <div class="col s12 m6 l6 xl6 row">
                            <a href="{{route('admin.products.edit',$product->id)}}" class="btn orange waves-effect waves-light col s12">
                                <i class="material-icons left">update</i>
                                Update
                            </a>
                        </div>
                        @component('components.confirm',[
                            'id'    => 'delete-form',
                            'modal' => 'deleteModal',
                            'title' => 'Product'
                        ])
                        @endcomponent
                        <div class="col s12 m6 l6 xl6 row">
                            <a href="#deleteModal" class="btn red waves-effect waves-light col s12 modal-trigger">
                                <i class="material-icons left">delete</i>
                                Delete
                            </a>
                        </div>
                        <form action="{{route('admin.products.destroy',$product->id)}}" method="post" class="hide" id="delete-form">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection