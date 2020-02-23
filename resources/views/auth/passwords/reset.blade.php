@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header text-4xl text-center mb-6">{{ __('Reset Password') }}</div>

    <div class="flex justify-center">
        <form method="POST"
              action="{{ route('password.update') }}"
              class="card w-1/2">
            @csrf

            <input type="hidden"
                   name="token"
                   value="{{ $token }}">

            <div class="flex mb-4">
                <label for="email"
                       class="text-xl mr-6 flex-1 flex justify-end items-center">{{ __('E-Mail Address') }}</label>

                <div class="flex-1">
                    <input id="email"
                           type="email"
                           class="rounded-lg border border-muted-light p-2 @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ $email ?? old('email') }}"
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
                       class="text-xl mr-6 flex-1 flex justify-end items-center">{{ __('Password') }}</label>

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
                       class="text-xl mr-6 flex-1 flex justify-end items-center">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm"
                           type="password"
                           class="rounded-lg border border-muted-light p-2"
                           name="password_confirmation"
                           required
                           autocomplete="new-password">
                </div>
            </div>

            <div class="flex">
                <div class="">
                    <button type="submit"
                            class="btn btn-primary">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection