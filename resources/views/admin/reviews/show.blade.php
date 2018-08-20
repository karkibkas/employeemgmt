@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card-panel">
                
                <ul class="collection with-header">
                    <li class="collection-header">
                        <h4 class="center">Review Details</h4>        
                    </li>
                    <li class="collection-item">
                        Customer Name : {{$review->user->name}}
                    </li>
                    <li class="collection-item">
                        Product Name : <a href="{{route('admin.products.show',$review->product->id)}}">{{$review->product->title}}</a>
                    </li>
                    <li class="collection-item">
                        <span>Rating : </span>
                        <span class="star">
                            @component('components.review-count',[
                                'product' => $review->product
                            ])
                            @endcomponent
                        </span>
                    </li>
                    <li class="collection-item">
                        Status : {{($review->status ? 'Enabled' : 'Disabled')}}
                    </li>
                    <li class="collection-item">
                        Reviewed at : {{$review->created_at->diffForHumans()}}
                    </li>
                    <li class="collection-item">
                    <li class="collection-item">
                        <div class="row">
                            <div class="col s12 m6 l6 xl6 row">
                                <a href="{{route('admin.reviews.edit',$review->id)}}" class="btn orange waves-effect waves-light col s12">
                                    <i class="material-icons left">update</i>
                                    Update
                                </a>
                            </div>
                            @component('components.confirm',[
                                'id'    => 'delete-form',
                                'modal' => 'deleteModal',
                                'title' => 'Review'
                            ])
                            @endcomponent
                            <div class="col s12 m6 l6 xl6 row">
                                <a href="#deleteModal" class="btn red waves-effect waves-light col s12 modal-trigger">
                                    <i class="material-icons left">delete</i>
                                    Delete
                                </a>
                            </div>
                            <form action="{{route('admin.reviews.destroy',$review->id)}}" method="post" class="hide" id="delete-form">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection