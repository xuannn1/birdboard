<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"
            defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch"
          href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}"
          rel="stylesheet">
</head>

<body class="bg-page theme-light">
    <div id="app">
        <nav class="bg-header">
            <div class="container mx-auto">
                <div class="flex justify-between items-center py-2">
                    <a class="text-default text-2xl font-medium tracking-wider"
                       href="{{ url('/projects') }}">
                        {{ config('app.name') }}
                    </a>

                    <div>
                        <!-- Right Side Of Navbar -->
                        <div class="navbar-nav ml-auto flex items-center">
                            <!-- Authentication Links -->
                            @guest
                            <a class="nav-link"
                               href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                            <a class="nav-link"
                               href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                            @else
                            <theme-switcher></theme-switcher>

                            <a class="flex items-center"
                               href="#"
                               role="button"
                               data-toggle="dropdown"
                               aria-haspopup="true"
                               aria-expanded="false"
                               v-pre>
                                <img width="35"
                                     src="{{ gravatar_url(auth()->user()->email) }}"
                                     alt="{{ Auth::user()->name }}"
                                     class="rounded-full mr-3">
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right"
                                 aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"
                                   href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form"
                                      action="{{ route('logout') }}"
                                      method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                            @endguest
                        </div>
                    </div>
                </div>

            </div>
        </nav>

        <main class="container py-4 mx-auto">
            @yield('content')
        </main>
    </div>
</body>

</html>