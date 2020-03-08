@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header text-4xl text-center mb-6">{{ __('Register') }}</div>

    <div class="flex justify-center">
        <form method="POST"
              action="{{ route('register') }}"
              class="card lg:w-1/2 w-full">
            @csrf

            <div class="lg:flex lg:mb-4 mb-2">
                <label for="name"
                       class="lg:mb-0 lg:flex form-menu-label">Name:</label>

                <div class="flex-1">
                    <input id="name"
                           type="text"
                           class="lg:w-2/3 form-menu-input @error('name') is-invalid @enderror"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           autocomplete="name"
                           autofocus>

                    @error('name')
                    <span class="invalid-feedback"
                          role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="lg:flex lg:mb-4 mb-2">
                <label for="email"
                       class="lg:mb-0 lg:flex form-menu-label">E-Mail Address:</label>

                <div class="flex-1">
                    <input id="email"
                           type="email"
                           class="lg:w-2/3 form-menu-input @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback"
                          role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="lg:flex lg:mb-4 mb-2">
                <label for="password"
                       class="lg:mb-0 lg:flex form-menu-label">Password:</label>

                <div class="flex-1">
                    <input id="password"
                           type="password"
                           class="lg:w-2/3 form-menu-input @error('password') is-invalid @enderror"
                           name="password"
                           required
                           autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback"
                          role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="lg:flex mb-4">
                <label for="password-confirm"
                       class="lg:mb-0 lg:flex form-menu-label">Confirm Password:</label>

                <div class="flex-1">
                    <input id="password-confirm"
                           type="password"
                           class="lg:w-2/3 form-menu-input"
                           name="password_confirmation"
                           required
                           autocomplete="new-password">
                </div>
            </div>

            <div class="flex">
                <div class="flex justify-end flex-1 mr-6 ">
                    <button type="submit"
                            class="btn-blue">
                        {{ __('Register') }}
                    </button>
                </div>
                <div class="flex flex-1">
                    <a href="{{ route('login') }}"
                       class="btn-white">
                        To Login
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection