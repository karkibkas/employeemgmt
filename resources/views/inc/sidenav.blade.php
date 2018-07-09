<ul class="sidenav bg" id="sidenav">
    <li>
        <a href="{{route('index')}}" class="grey-text text-lighten-3">
            <i class="material-icons grey-text text-lighten-3 left">home</i>
            Home
        </a>
    </li>
    <li>
        <a href="{{route('products')}}" class="grey-text text-lighten-3">
            <i class="material-icons grey-text text-lighten-3 left">shop</i>
            Products
        </a>
    </li>
    <li>
        <a href="{{route('about')}}" class="grey-text text-lighten-3">
            <i class="material-icons grey-text text-lighten-3 left">info_outline</i>
            About
        </a>
    </li>
    <li>
        <a href="{{route('contact')}}" class="grey-text text-lighten-3">
            <i class="material-icons grey-text text-lighten-3 left">contact_phone</i>
            Contact
        </a>
    </li>
    <li>
        <a href="{{route('cart')}}" class="grey-text text-lighten-3 val">
            <i class="material-icons left cart-icon grey-text text-lighten-3">shopping_cart</i>
            <span id="cart-count">My Cart ({{Cart::count()}})</span>
        </a>
    </li>
</ul>