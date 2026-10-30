@extends('layouts.customer')

@section('title', 'My Wishlist')

@section('content')
<x-guest-layout>

    <div class="simple-login">

        <a href="{{ route('storefront.home') }}" class="login-brand">
            Electro<span>Mart.</span>
        </a>

        <h2>Welcome Back</h2>
        <p class="login-subtitle">Sign in to continue shopping.</p>

        <x-auth-session-status
            class="mb-3"
            :status="session('status')"
        />

        @if ($errors->any())
            <div class="login-message">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="login-field">
                <label for="email">Email Address</label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                    autofocus
                    autocomplete="username"
                >
            </div>

            <div class="login-field">
                <label for="password">Password</label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                    autocomplete="current-password"
                >
            </div>

            <div class="login-options">

                <label class="remember-option">
                    <input type="checkbox" name="remember" value="1">
                    <span>Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Forgot password?
                    </a>
                @endif

            </div>

            <button type="submit" class="login-submit">
                Sign In
            </button>

        </form>

        <div class="login-register">
            Don't have an account?
            <a href="{{ route('register') }}">Create an account</a>
        </div>

        <div class="login-footer">
            © {{ date('Y') }} ElectroMart
        </div>

    </div>

</x-guest-layout>
@endsection