
@extends('layouts.customer')

@section('title', 'My Wishlist')

@section('content')
<x-guest-layout>

    <div class="register-card">

        <a href="{{ route('storefront.home') }}" class="register-logo">
            Electro<span>Mart.</span>
        </a>

        <h2>Create Account</h2>
        <p class="register-subtitle">Join ElectroMart and start shopping.</p>

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="register-message">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Full Name --}}
            <div class="register-field">
                <label for="name">Full Name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter your full name"
                    required
                    autofocus
                    autocomplete="name"
                >
            </div>

            {{-- Email --}}
            <div class="register-field">
                <label for="email">Email Address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email address"
                    required
                    autocomplete="username"
                >
            </div>

            {{-- Password --}}
            <div class="register-field">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Create a password"
                    required
                    autocomplete="new-password"
                >
            </div>

            {{-- Password requirements --}}
            <div class="password-requirements">
                <p>Password must contain:</p>
                <ul>
                    <li>At least 8 characters</li>
                    <li>At least one uppercase letter (A–Z)</li>
                    <li>At least one lowercase letter (a–z)</li>
                    <li>At least one number (0–9)</li>
                    <li>At least one special character (@, #, $, etc.)</li>
                </ul>
            </div>

            {{-- Confirm Password --}}
            <div class="register-field">
                <label for="password_confirmation">Confirm Password</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm your password"
                    required
                    autocomplete="new-password"
                >
            </div>

            <button type="submit" class="register-submit">
                Create Account →
            </button>

        </form>

        <div class="register-login">
            Already have an account?
            <a href="{{ route('login') }}">Sign in</a>
        </div>

        <div class="register-footer">
            © {{ date('Y') }} ElectroMart
        </div>

    </div>

</x-guest-layout>

@endsection