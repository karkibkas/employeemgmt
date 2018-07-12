<nav class="nav-wrapper bg">
    <div class="container-fluid">
        <a href="{{route('index')}}" class="brand-logo">LARACART</a>
        <ul class="show-on-med-and-small">
            <li class="waves-effect">
                <a href="#" data-target="sidenav" class="sidenav-trigger waves-effect"><i class="material-icons">menu</i></a>
            </li>
        </ul>
        {{-- check if we are not authenticated as an admin --}}
        @if(!Auth::guard('admin')->check())
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
                @auth
                    <li class="waves-effect">
                        <a href="#" onclick="this.preventDefault;document.querySelector('#user-logout').submit()">{{Auth::user()->name}} Logout</a>
                    </li>
                    <form action="{{route('logout')}}" class="hide" id="user-logout" method="post">
                        @csrf
                    </form>
                @else
                    <li class="waves-effect">
                        <a href="{{route('login')}}">Login</a>
                    </li>
                @endauth
                <li class="waves-effect">
                    <a href="{{route('cart.index')}}" class="val">
                        <i class="material-icons left cart-icon">shopping_cart</i>
                        <span class="cart-count">({{Cart::count()}})</span>
                    </a>
                </li>
            </ul>
        @else
            <ul class="hide-on-med-and-down right">
                <li>
                    <a href="#" class="dropdown-trigger" data-target="admin-dropdown">
                        {{Auth::guard('admin')->user()->name}}
                        <i class="material-icons right mt-3">arrow_drop_down</i>
                    </a>
                </li>
            </ul>
            {{-- dropdown for admin --}}
            <ul id='admin-dropdown' class='dropdown-content'>
                <li>
                    <a href="#">Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    {{-- this link submits a hidden form to log users out --}}
                    <a href="#" onclick="this.preventDefault;document.querySelector('#admin-logout').submit()">Logout</a>
                    <form action="{{route('admin.logout')}}" method="post" class="hide" id="admin-form">
                        @csrf
                    </form>
                </li>
            </ul>
        @endif
    </div>
</nav>

@if(Auth::guard('admin')->check())
    {{-- Include SideNav that's appropriate for admin --}}
    @include('admin.inc.sidenav')
@else
    {{-- Include SideNav that's appropriate for normal users or guests --}}
    @include('inc.sidenav')
@endif