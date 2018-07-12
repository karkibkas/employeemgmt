{{-- SideNav for Unauthenticated users--}}
@guest
<ul class="sidenav bg" id="sidenav">
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
        <a href="{{route('login')}}" class="waves-effect grey-text text-lighten-3">
            <i class="material-icons left grey-text text-lighten-3">person_outline</i>
            <span>Login</span>
        </a>
    </li>
    <li>
        <a href="{{route('register')}}" class="waves-effect grey-text text-lighten-3">
            <i class="material-icons left grey-text text-lighten-3">person_outline</i>
            <span>Register</span>
        </a>
    </li>
    <li>
        <a href="{{route('cart.index')}}" class="waves-effect grey-text text-lighten-3 val">
            <i class="material-icons left cart-icon grey-text text-lighten-3">shopping_cart</i>
            <span>My Cart </span><span class="cart-count">({{Cart::count()}})</span>
        </a>
    </li>
</ul>
@else
{{-- SideNav for authenticated --}}
<ul class="sidenav" id="sidenav">
    <li>
        <div class="user-view">
            <div class="background">
                <img src="{{asset('images/mt-bg.jpg')}}" width="100%" height="100%" alt="">
            </div>
            {{-- Get picture of authenicated user from gravatar --}}
            <a href="#"><img class="circle" src="{{Auth::user()->gravatar}}"></a>
            {{-- Get first and last name of authenicated user --}}
            <a href="#"><span class="white-text name">{{ Auth::user()->name }}</span></a>
            {{-- Get email of authenicated user --}}
            <a href="#"><span class="white-text email">{{ Auth::user()->email }}</span></a>
        </div>
    </li>
    <li>
        <a href="{{route('index')}}" class="waves-effect grey-text text-darken-1">
            <i class="material-icons grey-text text-darken-1 left">home</i>
            Home
        </a>
    </li>
    <li>
        <a href="{{route('products')}}" class="waves-effect grey-text text-darken-1">
            <i class="material-icons grey-text text-darken-1 left">shop</i>
            Products
        </a>
    </li>
    <li>
        <a href="{{route('about')}}" class="waves-effect grey-text text-darken-1">
            <i class="material-icons grey-text text-darken-1 left">info_outline</i>
            About
        </a>
    </li>
    <li>
        <a href="{{route('contact')}}" class="waves-effect grey-text text-darken-1">
            <i class="material-icons grey-text text-darken-1 left">contact_phone</i>
            Contact
        </a>
    </li>
    <li>
        <a href="#" onclick="this.preventDefault;document.querySelector('#user-logout').submit()" class="waves-effect grey-text text-darken-1">
            <i class="material-icons left grey-text text-darken-1">person_outline</i>
            <span>Logout</span>
        </a>
    </li>
    <li>
        <a href="{{route('cart.index')}}" class="waves-effect grey-text text-darken-1 val">
            <i class="material-icons left cart-icon grey-text text-darken-1">shopping_cart</i>
            <span>My Cart </span><span class="cart-count">({{Cart::count()}})</span>
        </a>
    </li>
</ul>
@endguest