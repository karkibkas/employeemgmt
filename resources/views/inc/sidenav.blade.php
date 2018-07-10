<ul class="sidenav bg {{auth::guard('admin')->check() ? 'sidenav-fixed' : ''}}" id="sidenav">
    <li>
        <a href="{{route('index')}}" class="waves-effect grey-text text-lighten-3">
            <i class="material-icons grey-text text-lighten-3 left">home</i>
            Home
        </a>
    </li>
    <li>
        <a href="{{route('products')}}" class="waves-effect grey-text text-lighten-3">
            <i class="material-icons grey-text text-lighten-3 left">shop</i>
            Products
        </a>
    </li>
    <li>
        <a href="{{route('about')}}" class="waves-effect grey-text text-lighten-3">
            <i class="material-icons grey-text text-lighten-3 left">info_outline</i>
            About
        </a>
    </li>
    <li>
        <a href="{{route('contact')}}" class="waves-effect grey-text text-lighten-3">
            <i class="material-icons grey-text text-lighten-3 left">contact_phone</i>
            Contact
        </a>
    </li>
    <li>
        <a href="{{route('cart.index')}}" class="waves-effect grey-text text-lighten-3 val">
            <i class="material-icons left cart-icon grey-text text-lighten-3">shopping_cart</i>
            <span class="cart-count">My Cart ({{Cart::count()}})</span>
        </a>
    </li>
    @if(Auth::guard('admin')->check())
    <li class="show-on-med-and-small hide-on-large-only">
        <a href="#" class="waves-effect grey-text text-lighten-3" onclick="this.preventDefault;document.querySelector('#admin-logout').submit()">
            <i class="material-icons grey-text text-lighten-3 left">person</i>
            {{Auth::guard('admin')->user()->name}} Logout
        </a>
    </li>
    @endif
</ul>