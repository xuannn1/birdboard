@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header text-4xl text-center mb-6">{{ __('Register') }}</div>

    <div class="flex justify-center">
        <form method="POST"
              action="{{ route('register') }}"
              class="card w-1/2">
            @csrf

            <div class="flex mb-4">
                <label for="name"
                       class="text-xl mr-6 flex-1 flex justify-end items-center">Name:</label>

                <div class="flex-1">
                    <input id="name"
                           type="text"
                           class="rounded-lg border border-muted-light p-2 @error('name') is-invalid @enderror"
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

            <div class="flex mb-4">
                <label for="email"
                       class="text-xl mr-6 flex-1 flex justify-end items-center">E-Mail Address:</label>

                <div class="flex-1">
                    <input id="email"
                           type="email"
                           class="rounded-lg border border-muted-light p-2 @error('email') is-invalid @enderror"
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

            <div class="flex mb-4">
                <label for="password"
                       class="text-xl mr-6 flex-1 flex justify-end items-center">Password:</label>

                <div class="flex-1">
                    <input id="password"
                           type="password"
                           class="rounded-lg border border-muted-light p-2 @error('password') is-invalid @enderror"
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

            <div class="flex mb-4">
                <label for="password-confirm"
                       class="text-xl mr-6 flex-1 flex justify-end items-center">Confirm Password:</label>

                <div class="flex-1">
                    <input id="password-confirm"
                           type="password"
                           class="rounded-lg border border-muted-light p-2"
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
                        Return To Login
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection