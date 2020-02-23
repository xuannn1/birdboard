@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header text-4xl text-center mb-6">{{ __('Login') }}</div>

    <div class="flex justify-center">
        <form method="POST"
              action="{{ route('login') }}"
              class="card w-1/2">
            @csrf

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

            <div class="flex mb-2">
                <label for="password"
                       class="text-xl mr-6 flex-1 flex justify-end items-center">Password:</label>

                <div class="flex-1 col-md-6">
                    <input id="password"
                           type="password"
                           class="rounded-lg border border-muted-light p-2 @error('password') is-invalid @enderror"
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

            <div class="flex mb-4 justify-end">
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
                    @if (Route::has('password.request'))
                    <a class="btn-white"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@endsection