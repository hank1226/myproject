{{-- refer to : https://www.youtube.com/watch?v=p1GmFCGuVjw --}}
<header >
    <h2 class="logo"> {{ config('app.name', 'Laravel') }}</h2>
    <nav class="navigation">
        @if(!Auth::guest())
            <a class = "items" href="{{ url('/') }}">Home Page</a>
            <a class = "items" href="{{ url('/dhts') }}">DHTs</a>
            <a class = "items" href="{{ url('/pzems') }}">PZEMs</a>
            <a class = "items" href="{{ url('/devices') }}">Devices</a>       
            <div class="dropdown">
                <a id="navbarDropdown" class="dropdown-btn items" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <i class="fa-solid fa-caret-down"></i>
                </a>
                <div class="dropdown-content">
                    <a class = "items" href="{{ url('/dashboard') }}">Create Device</a>
                    <div class="dropdown-divider"></div>
                    <a class = "items" href="{{ url('/dhts/create') }}">Create DHT</a>
                    <a class = "items" href="{{ url('/pzems/create') }}">Create PZEM</a>
                    <div class="dropdown-divider"></div>
                    <a class = "items" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
        @else
            {{-- <button class="btnLogin-popup"><a href="{{ url('/login') }}" class="login-link">Login</a></button> --}}
        @endif
    </nav>
</header>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', 'sans-serif';
    }

    body {
        margin: 6em;
        background-color:#e3f2fd;
    }


    header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        padding: 20px 100px;
        background: #162938;;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 99;
    }

    .logo {
        font-size: 2em;
        color: #fff;
        user-select: none;
    }

    .navigation .items {
        position: relative;
        font-size: 1.1em;
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        margin-left: 40px;
    }

    .navigation .items::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -6px;
        width: 100%;
        height: 3px;
        background: #fff;
        border-radius: 5px;
        transform-origin: right;
        transform: scaleX(0);
        transition: transform .5s;
    }
    
    .navigation .items:hover::after{
        transform-origin: left;
        transform: scaleX(1);
    } 

    .navigation .btnLogin-popup,
    .navigation .login-link {
        width: 130px;
        height: 50px;
        background: transparent;
        border: 2px solid #fff;
        outline: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 1.1em;
        color: #fff;
        font-weight: 500;
        /* margin-left: 0px; */
        transition: .5s;
        text-decoration: none;
        text-align: center;
        display: flex; 
        justify-content: center;
        align-items: center;
    }

    .navigation .btnLogin-popup:hover,
    .navigation .login-link:hover {
        background: #fff;
        color: #162938;
    } 

    /* dropdown */
    .navigation .dropdown {
        position: relative;
        display: inline-block;
        border: none;
    }

    .navigation .dropdown-btn {
        position: relative;
        display: inline-block;
        cursor: pointer;
        width: 120px;
        text-align: center; 
        padding: 10px;
        background-color: #162938; 
        border: 1px solid skyblue;
        border-radius: 4px;
        line-height: 1.5;
        color: #fff;
    }

    .navigation .dropdown-content {
        display: none;
        position: absolute;
        background-color: #162938;
        min-width: 12em;
        box-shadow: 0 0px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
        padding: 10px;
        margin-left: 0;
        text-align: center; 
        top: 100%; 
        left: 50%; 
        transform: translateX(-50%);
        margin-left: 20px;
    }

    .navigation .dropdown-content a {
        display: block;
        padding: 10px; 
        margin-left: 0;
        color: #fff;
        text-decoration: none;
    }

    .navigation .dropdown-content a:hover {
        background-color: #0c3d5d;
    }

    .navigation .dropdown:hover .dropdown-content {
        display: block;
    }

    .fa-caret-down {

        margin-top: 4px;
        float: right;
    }
    
</style>


{{-- <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @if(!Auth::guest())                        
                        <div class="navbar-nav">
                            <a class="nav-link" href="{{ url('/') }}">Home Page</a>
                            <a class="nav-link" href="{{ url('/dhts') }}">DHTs</a>
                            <a class="nav-link" href="{{ url('/pzems') }}">PZEMs</a>
                            <a class="nav-link" href="{{ url('/devices') }}">Devices</a>
                        </div>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="nav-link" href="{{ url('/dashboard') }}">Create Device</a>
                                <div class="dropdown-divider"></div>
                                <a class="nav-link" href="{{ url('/dhts/create') }}">Create DHT</a>
                                <a class="nav-link" href="{{ url('/pzems/create') }}">Create PZEM</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
    
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            @endif
            </ul>
        </div>
    </div>
</nav> --}}