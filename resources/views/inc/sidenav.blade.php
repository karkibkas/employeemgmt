{{-- SideNav for Unauthenticated users--}}
@guest
<ul class="sidenav bg" id="sidenav">
    <li>
        <form action="{{route('search')}}" id="search-form-mb">
            <div class="search-box">
                <a href="#" id="search-icon-mb" class="left">
                    <i class="material-icons grey-text">search</i>
                </a>
                <input type="search" name="search" id="mobile-search" placeholder="Search Products" class="browser-default">
                <a href="#" id="search-close-mb" class="right">
                    <i class="material-icons transparent-text close-icon-mb">close</i>
                </a>
                <ul id="search-results-mb" class="z-depth-1 grey lighten-3 collection with-header">
                </ul>
            </div>
        </form>
    </li>
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
            <a href="{{route('profile')}}"><img class="circle" src="{{Auth::user()->gravatar}}"></a>
            {{-- Get first and last name of authenicated user --}}
            <a href="{{route('profile')}}"><span class="white-text name">{{ Auth::user()->name }}</span></a>
            {{-- Get email of authenicated user --}}
            <a href="{{route('profile')}}"><span class="white-text email">{{ Auth::user()->email }}</span></a>
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
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header waves-effect grey-text text-darken-1">
                <i class="material-icons pl-15 grey-text text-darken-1">supervisor_account</i>
                <span class="pl-15">{{Auth::user()->name}}</span>
            </a>
            <div class="collapsible-body">
              <ul>
                <li>
                    <a href="{{route('profile')}}" class="grey-text text-darken-1 waves-effect">
                        <i class="material-icons">info</i>
                        My Profile
                    </a>
                </li>
                <li>
                    <a href="{{route('order.index')}}" class="grey-text text-darken-1 waves-effect">
                        <i class="material-icons">list</i>
                        My Order History
                    </a>
                </li>
                <li>
                    <a href="{{route('wishlist.index')}}" class="grey-text text-darken-1 waves-effect">
                        <i class="material-icons">favorite</i>
                        My Wishlist
                    </a>
                </li>
                <li>
                    <a href="#" class="grey-text text-darken-1 waves-effect" onclick="this.preventDefault;document.querySelector('#user-logout').submit()">
                        <i class="material-icons">input</i>
                        Logout
                    </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
    </li>
    <li>
        <a href="{{route('cart.index')}}" class="waves-effect grey-text text-darken-1 val">
            <i class="material-icons left cart-icon grey-text text-darken-1">shopping_cart</i>
            <span class="grey-text text-darken-1">My Cart </span><span class="cart-count">({{Cart::count()}})</span>
        </a>
    </li>
</ul>
@endguest