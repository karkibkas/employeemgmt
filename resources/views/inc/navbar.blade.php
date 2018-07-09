<nav class="nav-wrapper bg">
    <div class="container-fluid">
        <a href="{{route('index')}}" class="brand-logo">LARACART</a>
        <ul class="show-on-med-and-small">
            <li class="waves-effect">
                <a href="#" data-target="sidenav" class="sidenav-trigger waves-effect"><i class="material-icons">menu</i></a>
            </li>
        </ul>
        <ul class="hide-on-med-and-down right">
            <li class="waves-effect">
                <a href="{{route('index')}}">Home</a>
            </li>
            <li class="waves-effect">
                <a href="{{route('products')}}">Products</a>
            </li>
            <li class="waves-effect">
                <a href="{{route('about')}}">About</a>
            </li>
            <li class="waves-effect">
                <a href="{{route('contact')}}">Contact</a>
            </li>
            <li class="waves-effect">
                <a href="{{route('cart')}}" class="val">
                    <i class="material-icons left cart-icon">shopping_cart</i>
                    <span id="cart-count">({{Cart::count()}})</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

@include('inc.sidenav')