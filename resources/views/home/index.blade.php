@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
@endsection
@section('content')
<div class="container-fluid">
    <div class="carousel carousel-slider center">
        <div class="carousel-fixed-item center">
            <a class="btn waves-effect waves-light bg2" href="{{route('products')}}">
                Shop Now
                <i class="material-icons right">chevron_right</i>
            </a>
        </div>
        <div class="carousel-item white-text" href="#one!">
            <img src="{{asset('images/slider/img1.jpg')}}" alt="" class="slider-img">
        </div>
        <div class="carousel-item white-text" href="#two!">
            <img src="{{asset('images/slider/img2.jpeg')}}" alt="" class="slider-img">
        </div>
        <div class="carousel-item white-text" href="#three!">
            <img src="{{asset('images/slider/img3.jpeg')}}" alt="" class="slider-img">
        </div>
        <div class="carousel-item white-text" href="#four!">
            <img src="{{asset('images/slider/img4.jpeg')}}" alt="" class="slider-img">
        </div>
    </div>
    <br><br>
    <div class="row">
        <h4 class="center grey-text text-darken-2">Featured Products</h4>
        <br><br>
        <!-- Set up your HTML -->
        <div class="owl-carousel row">
            @foreach($products as $product)
                <div class="card-panel product-card no-padding featured-product">
                    <a href="{{route('product-details',$product->slug)}}">
                        <div class="prod-card-img">
                            @if($product->outOfStock())
                                <span class="chip red lighten-1 white-text prod-chip">out of stock!</span>
                            @endif
                            @if($product->hasLowStock())
                                <span class="chip yellow prod-chip">Low Stock!</span>
                            @endif
                            <img src="{{asset('storage/products/'.$product->image)}}" alt="">
                        </div>
                        <div class="prod-details">
                            <div class="prod-title">
                                
                                <a href="#" class="grey-text text-darken-2 truncate">{{$product->title}}</a>
                            </div>
                            <br>
                            Price: <span class="val">${{$product->price}}</span>
                            <div class="d-flex">
                                <span>Ratings : </span>
                                <i class="material-icons yellow-text">star</i>
                                <i class="material-icons yellow-text">star</i>
                                <i class="material-icons yellow-text">star</i>
                                <i class="material-icons yellow-text">star</i>
                                <i class="material-icons yellow-text">star</i>
                            </div>
                            <div class="center prod-options">
                                <a href="{{route('product-details',$product->slug)}}" data-id="{{$product->id}}" class="add-cart tooltipped btn bg2 waves-effect waves-light {{($product->outOfStock()) ? 'disabled white-text' : ''}}" data-position="bottom" data-tooltip="Add to Cart">
                                    <i class="material-icons">add_shopping_cart</i>
                                </a>
                                <a href="#" data-id="{{$product->id}}" class="add-wishlist tooltipped btn bg2 waves-effect waves-light" data-position="bottom" data-tooltip="Add to wishlist">
                                    <i class="material-icons">favorite_border</i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <br><br>
</div>
@endsection

@section('script')
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel({
                loop:true,
                margin:15,
                autoplay:true,
                autoplayTimeout:5000,
                autoplayHoverPause:false,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    992:{
                        items:4
                    },
                    1250:{
                        items:5
                    }
                }
            }
            );
        });
    </script>
@endsection