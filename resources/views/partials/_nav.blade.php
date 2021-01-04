<div class="d-flex flex-column flex-md-row align-items-center p-2 px-md-4 sticky-top" style="background-color: black">
    <img src="{{asset('growth.png')}}" alt="logo" width="50" height="40">
    <a href="{{ route('home.index') }}" class="my-0 mr-md-auto ml-2"
       style="color: #41A317; font-family: Montserrat; font-size: 28px; text-decoration: none">Investing</a>

    <nav class="my-2 mr-md-2" style="font-family: Montserrat; font-size: 18px">
        <a class="p-2" style="color: #41A317" href="{{ route('home.index') }}">Home</a>
        @if( auth()->check() )
            <a class="p-2" style="color: #41A317" href="{{ route('blog.index') }}">Blog</a>
            <a class="p-2" style="color: #41A317" href="{{ route('posts.index') }}">My posts</a>
        @endif
        <a class="p-2" style="color: #41A317" href="{{ route('about') }}">About us</a>
    </nav>

    @if( auth()->check() )
        <div class="dropdown" style="font-family: Montserrat">
            <button class="btn btn-success dropdown-toggle" id="notifications" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="true">
                <i class="fas fa-user"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationsMenu" id="notificationsMenu">
                <a class="dropdown-header">No notifications</a>
            </div>
        </div>

        <div class="dropdown ml-2" style="font-family: Montserrat">
            <button class="btn btn-success dropdown-toggle" style="font-size: 16px" type="button"
                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ Auth::user()->profile->image->url }}"
                     style="width:32px; height:32px;  top:10px; left:10px; border-radius:50%">
                {{ auth()->user()->name }}
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

                <a class="dropdown-item" href="{{ route('profile.edit', auth()->user()->id) }}">My Account</a>

                @can('manage-posts-comments')
                    <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                @endcan

                @can('manage-roles')
                    <a class="dropdown-item" href="{{ route('roles.index') }}">Assign Roles</a>
                @endcan

                <a class="dropdown-item" href="{{ route('users') }}">Users</a>
                <a class="dropdown-item" href="{{ route('posts.create') }}">Create Post</a>
                <a class="dropdown-item" href="{{ route('currency.index') }}">Exchange Rates</a>

                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Sign out</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    @else
        <a class="btn btn-lg btn-success" href="{{ route('login') }}" role="button"
           style="font-family: Montserrat; font-size: 16px">Login</a>
    @endif

</div>

