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
              class="card lg:w-1/2 w-10/12">
            @csrf

            <div class="lg:flex mb-4 ">
                <label for="email"
                       class="lg:mb-0 lg:flex form-menu-label">E-Mail Address:</label>

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