@if($product->reviews->avg('rating'))
    @for($i = 0; $i<$product->reviews->avg('rating'); $i++)
        <i class="material-icons yellow-text text-darken-1 star">star</i>
    @endfor
@else
<span>no reviews!</span>
@endif