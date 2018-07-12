<ul id="sidenav" class="sidenav sidenav-fixed grey lighten-4">
    <li>
        <div class="user-view">
            <div class="background">
                <img src="{{asset('images/mt-bg.jpg')}}" width="100%" height="100%" alt="">
            </div>
            {{-- Get the picture of authenicated user from gravatar --}}
            <a href="#"><img class="circle" src="{{Auth::guard('admin')->user()->gravatar}}"></a>
            {{-- Get the name of authenicated user --}}
            <a href="#"><span class="white-text name">{{ Auth::guard('admin')->user()->name }}</span></a>
            {{-- Get the email of authenicated user --}}
            <a href="#"><span class="white-text email">{{ Auth::guard('admin')->user()->email }}</span></a>
        </div>
    </li>
    <li>
        <a href="{{route('admin.dashboard')}}" class="waves-effect grey-text text-darken-1" onclick="this.preventDefault;document.querySelector('#admin-logout').submit()">
            <i class="material-icons grey-text text-darken-1">dashboard</i>
            Dashboard
        </a>
    </li>
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header waves-effect grey-text text-darken-1">
                <i class="material-icons pl-15 grey-text text-darken-1">shop</i>
                <span class="pl-15">Manage Products</span>
            </a>
            <div class="collapsible-body">
              <ul>
                <li>
                    <a href="#!" class="grey-text text-darken-1">
                        <i class="material-icons">list</i>
                        Products List
                    </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
    </li>
    <li>
        <a href="#" class="waves-effect grey-text text-darken-1">
            <i class="material-icons grey-text text-darken-1">settings</i>
            Settings
        </a>
    </li>
    <li class="show-on-med-and-small hide-on-large-only divider"></li>
    <li class="show-on-med-and-small hide-on-large-only">
        <a href="#" class="waves-effect grey-text text-darken-1" onclick="this.preventDefault;document.querySelector('#admin-logout').submit()">
            <i class="material-icons grey-text text-darken-1">person</i>
            Logout
        </a>
        <form action="{{route('admin.logout')}}" class="hide" id="admin-logout" method="post">
            @csrf
        </form>
    </li>
</ul>