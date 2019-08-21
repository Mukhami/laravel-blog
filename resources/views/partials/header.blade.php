{{--<nav class="navbar navbar-default">--}}
{{--    <div class="container-fluid">--}}
{{--        <div class="navbar-header">--}}
{{--            <a href="{{ route('blog.index') }}" class="navbar-brand">Laravel-Blog</a>--}}
{{--            <ul class="nav navbar-nav">--}}
{{--                <li><a href="{{ route('blog.index') }}">Blog</a></li>--}}
{{--                <li><a href="{{ route('other.about') }}">About</a></li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}

{{--<nav class="navbar navbar-default navbar-static-top">--}}
{{--    <div class="container">--}}
{{--        <div class="navbar-header">--}}

{{--            <!-- Collapsed Hamburger -->--}}
{{--            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">--}}
{{--                <span class="sr-only">Toggle Navigation</span>--}}
{{--                <span class="icon-bar"></span>--}}
{{--                <span class="icon-bar"></span>--}}
{{--                <span class="icon-bar"></span>--}}
{{--            </button>--}}

{{--            <!-- Branding Image -->--}}
{{--            <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                Laravel-Blog--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        <div class="collapse navbar-collapse" id="app-navbar-collapse">--}}
{{--            <!-- Left Side Of Navbar -->--}}
{{--            <ul class="nav navbar-nav">--}}
{{--                &nbsp; <li><a href="{{ route('blog.index') }}">Blog</a></li>--}}
{{--                  <li><a href="{{ route('other.about') }}">About</a></li>--}}
{{--            </ul>--}}

{{--            <!-- Right Side Of Navbar -->--}}
{{--            <ul class="nav navbar-nav navbar-right">--}}
{{--                <!-- Authentication Links -->--}}
{{--                @if (Auth::guest())--}}
{{--                    <li><a href="{{ url('/login') }}">Login</a></li>--}}
{{--                    <li><a href="{{ url('/register') }}">Register</a></li>--}}
{{--                @else--}}
{{--                    <li class="dropdown">--}}
{{--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
{{--                            {{ Auth::user()->name }} <span class="caret"></span>--}}
{{--                        </a>--}}

{{--                        <ul class="dropdown-menu" role="menu">--}}
{{--                            <li>--}}
{{--                                <a href="{{ url('/logout') }}"--}}
{{--                                   onclick="event.preventDefault();--}}
{{--                                                 document.getElementById('logout-form').submit();">--}}
{{--                                    Logout--}}
{{--                                </a>--}}

{{--                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">--}}
{{--                                    {{ csrf_field() }}--}}
{{--                                </form>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                @endif--}}
{{--                <li><a href="{{ route('bookmarks') }}">Bookmarks</a></li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}

<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ url('/') }}">
        Laravel-Blog
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('blog.explore') }}">Explore <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('bookmarks') }}">Bookmarks</a></li>
{{--        </ul>--}}
{{--        <ul class="navbar-nav mr-auto">--}}
            <li class="nav-item">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a class="nav-link " href="{{ url('/login') }}">Login</a></li>
                    <li><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" aria-labelledby="navbarDropdown" href="{{ route('admin.index') }}">My Profile</a></li>
                            <li>
                                <a class="dropdown-item" aria-labelledby="navbarDropdown" href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
        </ul>



        <form class="form-inline my-2 my-lg-0" action="{{route('search')}}">
            <input class="form-control mr-sm-2"  id="query" name="query" type="query" value="{{ request()->input('query') }}" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
