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
            @auth
                <li>
                    <a href="#" class="dropdown-trigger" data-target="user-dropdown">
                        {{Auth::user()->name}}
                        <i class="material-icons right mt-3">arrow_drop_down</i>
                    </a>
                </li>
                <ul id='user-dropdown' class='dropdown-content'>
                    <li>
                        <a href="{{route('profile')}}">Profile</a>
                    </li>
                    <li>
                        <a href="{{route('order.index')}}">Order History</a>
                    </li>
                    <li>
                        <a href="{{route('wishlist.index')}}">My Wishlist</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        {{-- this link submits a hidden form to log users out --}}
                        <a href="#" onclick="this.preventDefault;document.querySelector('#user-logout').submit()">Logout</a>
                        <form action="{{route('logout')}}" method="post" class="hide" id="user-logout">
                            @csrf
                        </form>
                    </li>
                </ul>
            @else
                <li class="waves-effect">
                    <a href="{{route('login')}}">Login</a>
                </li>
                <li class="waves-effect">
                    <a href="{{route('register')}}">Register</a>
                </li>
            @endauth
            <li class="waves-effect">
                <a href="{{route('cart.index')}}" class="val">
                    <i class="material-icons left cart-icon">shopping_cart</i>
                    <span class="cart-count">({{Cart::count()}})</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

{{-- Include SideNav that's appropriate for normal users or guests --}}
@include('inc.sidenav')