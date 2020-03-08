<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />

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
    <div id="app"
         class="">
        <nav class="bg-header">
            <div class="container mx-auto">
                <div class="flex justify-between items-center py-2 mx-4 lg:mx-0">
                    <a class="text-default text-2xl font-medium tracking-wider"
                       href="{{ url('/projects') }}">
                        {{ config('app.name') }}
                    </a>

                    <div>
                        <!-- Right Side Of Navbar -->
                        <div class="flex">
                            <!-- Authentication Links -->
                            @guest
                            <a class="tab-blue"
                               href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                            <a class="tab-blue"
                               href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                            @else
                            <theme-switcher></theme-switcher>

                            <dropdown>
                                <template v-slot:trigger>
                                    <button class="flex items-center">
                                        <img width="35"
                                             src="{{ gravatar_url(auth()->user()->email) }}"
                                             alt="{{ Auth::user()->name }}"
                                             class="rounded-full mr-3">
                                        <span>{{ Auth::user()->name }}</span>
                                    </button>
                                </template>

                                <form method="POST"
                                      action="/logout">
                                    @csrf
                                    <button type="submit"
                                            class="dropdown-menu-link">Logout</button>
                                </form>
                            </dropdown>

                            @endguest
                        </div>
                    </div>
                </div>

            </div>
        </nav>

        <main class="container py-4 mx-auto">
            <div class="mx-4 lg:mx-0">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>