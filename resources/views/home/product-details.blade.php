@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <h3 class="grey-text text-darken-2 center">{{$product->title}}</h3>
        <br><br>
        <div class="col s12 m12 l6 xl6">
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
            </ul>
        </div>
        <div class="col s12 m12 l6 xl6 grey-text text-darken-2">
            <div class="card-panel">
                <div class="">
                    <h5>{{$product->title}}</h5>
                </div>
                <div class="collection-item">
                    <br><br>
                    <p><strong>Price:</strong> <span class="val grey-text text-darken-1">${{$product->price}}</span></p>
                    <p>Available Quantity: <span class="val grey-text text-darken-1">{{$product->quantity}}</span></p>
                    @if($product->hasLowStock())
                        <span class="chip yellow">Low Stock</span>
                        <br>
                    @endif
                    <br>
                    @if(!$product->outOfStock())
                        <div class="section">
                            <form method="post">
                                @csrf
                                <div class="row"  style="margin-bottom:0 !important">
                                    <div class="col">
                                    </div>
                                    <div class="input-field col">
                                        <select name="qty" id="qty">
                                            @for($i = 0; $i < $product->quantity; $i++)
                                                <option value="{{$i+1}}">{{$i+1}}</option>
                                            @endfor
                                        </select>
                                        <label>Quantity</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="divider"></div>
                        <br>
                        <div class="section center">
                            <a href="#" data-id="{{$product->id}}" class="add-cart btn bg2 waves-effect waves-light tooltipped" data-position="bottom" data-tooltip="Add to Cart"><i class="material-icons">add_shopping_cart</i></a>
                            <a href="#" id="wishlist-btn" class="btn bg2 waves-effect waves-light tooltipped" data-position="bottom" data-tooltip="Add to Wishlist"><i class="material-icons">favorite_border</i></a>
                            <form id="wishlist-form" action="{{route('wishlist.add')}}" method="post" class="hide">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                            </form>
                        </div>
                    @else
                        <span class="chip white-text red lighten-1">
                            Out Of Stock
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card-panel">
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s6">
                        <a href="#description" class="purple-text">Description</a>
                    </li>
                    <li class="tab col s6">
                        <a class="active purple-text" href="#reviews">
                            Reviews 
                            <span class="val">({{$reviews->count()}})</span>
                        </a>
                    </li>
                </ul>
                </div>
                <div id="description" class="col s12">
                    <div class="row">
                        <div class="col xl12">
                            <br>
                            <h4>{{$product->title}}'s Details</h4>
                            <p>{!! $product->description !!}</p>
                            <br>
                        </div>
                    </div>
                </div>
                <div id="reviews" class="col s12">
                    <br>
                    @auth
                        @if(!App\Review::where('user_id',Auth::id())->first())
                            <h5 class="col">Leave a review.</h5>
                            <form action="{{route('reviews.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="input-field col s12 login-field">
                                    <textarea name="description" id="description" class="materialize-textarea">{{old('description')}}</textarea>
                                    <label for="description">My Review</label>
                                    @if($errors->has('description'))
                                        <span class="helper-text red-text">
                                            {{$errors->first('description')}}
                                        </span>
                                    @endif
                                </div>
                                <div class="input-field col s12 m4 offset-m4 l2 login-field">
                                <select name="rating" id="rating">
                                    @for($i = 1; $i < 5; $i++)
                                        <option value="{{$i}}" {{ ($i === 5) ? 'selected' : '' }}>{{$i}}</option>
                                    @endfor
                                </select>
                                <label>Rating</label>
                                @if($errors->has('rating'))
                                    <span class="helper-text red-text">
                                        {{$errors->first('rating')}}
                                    </span>
                                @endif
                                </div>
                                <div class="row"></div>
                                <button type="submit" class="btn bg waves-effect waves-light col s10 offset-s1 m4 offset-m4 l2 offset-l5">Submit</button>
                            </form>
                            <br><br>
                        @endif
                    @else
                        <br>
                        <h6 class="center">Please login or register to write a review!</h6>
                        <br>
                    @endauth
                    @forelse($reviews as $review)
                        <ul class="collection review">
                            <li class="collection-item avatar">
                                <img src="{{$review->user->gravatar}}" alt="{{$review->user->name}}" class="circle">
                                <span class="title grey-text text-darken-1">{{$review->user->name}} &nbsp;</span>
                                <span> {{$review->created_at->diffForHumans()}}</span>
                                <br>
                                <span>
                                    @for($i = 0; $i < 5; $i++)
                                        <i class="material-icons {{($i < $review->rating) ? 'yellow-text text-darken-1' : 'grey-text text-lighten-2'}}">star</i>
                                    @endfor
                                </span>
                            </li>
                            <li class="collection-item">
                                <p>{{$review->text}}</p>
                            </li>
                        </ul>
                        <br>
                    @empty
                        <h5>No Reviews yet!</h5>
                    @endforelse
                    <div class="center-align">
                        {{$reviews->links('vendor.pagination.default',[
                            'items' => $reviews
                        ])}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection