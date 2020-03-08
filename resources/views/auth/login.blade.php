@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header text-4xl text-center mb-6">{{ __('Login') }}</div>

    <div class="flex justify-center">
        <form method="POST"
              action="{{ route('login') }}"
              class="card lg:w-1/2 w-10/12">
            @csrf

            <div class="lg:flex lg:mb-4 mb-2">
                <label for="email"
                       class="lg:mb-0 lg:flex form-menu-label">E-Mail
                    Address:</label>

                <div class="flex-1">
                    <input id="email"
                           type="email"
                           class="lg:w-2/3 form-menu-input @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autocomplete="email"
                           autofocus>

                    @error('email')
                    <span class="invalid-feedback"
                          role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="lg:flex mb-2">
                <label for="password"
                       class="lg:mb-0 lg:flex form-menu-label">Password:</label>

                <div class="flex-1 col-md-6">
                    <input id="password"
                           type="password"
                           class="lg:w-2/3 form-menu-input @error('password') is-invalid @enderror"
                           name="password"
                           required
                           autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback"
                          role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="lg:flex mb-4 justify-end">
                <div class="mr-20">
                    <div class="form-check">
                        <input class="form-check-input"
                               type="checkbox"
                               name="remember"
                               id="remember"
                               {{ old('remember') ? 'checked' : '' }}>

                        <label class="text-sm "
                               for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex">
                <div class="flex justify-end flex-1 mr-6 ">
                    <button type="submit"
                            class=" btn-blue">
                        {{ __('Login') }}
                    </button>
                </div>

                <div class="flex flex-1">
                    <a class=" btn-white"
                       href="{{ route('register') }}">
                        {{ __('Register') }}
                    </a>
                </div>
                {{-- <div class="flex flex-1">
                    @if (Route::has('password.request'))
                    <a class="btn-white"
                       href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div> --}}
    </div>
    </form>
</div>
</div>
@endsection