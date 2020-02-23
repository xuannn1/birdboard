@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header text-4xl text-center mb-6">{{ __('Reset Password') }}</div>

    <div class="flex justify-center">
        @if (session('status'))
        <div class="alert alert-success"
             role="alert">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST"
              action="{{ route('password.email') }}"
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

            <div class="flex justify-center">
                <button type="submit"
                        class="btn-blue">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection