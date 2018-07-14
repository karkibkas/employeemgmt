<div class="col s12 m6 l4 xl3">
    <a href="{{route('product-details',$product->slug)}}">
        <div class="card-panel no-padding hoverable">
            <div class="prod-card-img">
                <img src="{{asset('storage/products/'.$product->image)}}" alt="">
            </div>
            <div class="prod-details">
                <div class="prod-title">
                    <a href="#" class="grey-text text-darken-2 truncate">{{$product->title}}</a>
                </div>
                <div class="prod-desc">
                    <p class="grey-text text-darken-1">
                        {!!substr($product->description,0,50)!!}..
                    </p>
                </div>
                <span class="val">${{$product->price}}</span>
                <div class="d-flex">
                    <span>Ratings : </span>
                    <i class="material-icons yellow-text">star</i>
                    <i class="material-icons yellow-text">star</i>
                    <i class="material-icons yellow-text">star</i>
                    <i class="material-icons yellow-text">star</i>
                    <i class="material-icons yellow-text">star</i>
                </div>
                <div class="center prod-options">
                    <a href="{{route('product-details',$product->slug)}}" class="tooltipped btn bg2 waves-effect waves-light" data-position="bottom" data-tooltip="Add to Cart">
                        <i class="material-icons">add_shopping_cart</i>
                    </a>
                    <a href="#" class="tooltipped btn bg2 waves-effect waves-light" data-position="bottom" data-tooltip="Add to wishlist">
                        <i class="material-icons">favorite_border</i>
                    </a>
                </div>
            </div>
        </div>
    </a>
</div>