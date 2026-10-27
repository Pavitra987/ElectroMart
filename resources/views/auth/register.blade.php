<x-guest-layout>

    <div class="register-wrapper">

        <!-- Left Orange Section -->
      <x-guest-layout>

    <div class="register-card">

        <a href="{{ route('storefront.home') }}" class="register-logo">
            Electro<span>Mart.</span>
        </a>

        <h2>Create Account</h2>
        <p class="register-subtitle">Join ElectroMart and start shopping.</p>

        @if ($errors->any())
            <div class="register-message">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="register-field">
                <label for="name">Full Name</label>
                <input id="name" type="text" name="name"
                       value="{{ old('name') }}"
                       placeholder="Enter your full name"
                       required autofocus autocomplete="name">
            </div>

            <div class="register-field">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="Enter your email address"
                       required autocomplete="username">
            </div>

            <div class="register-field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password"
                       placeholder="Create a password"
                       required autocomplete="new-password">
            </div>

            <div class="register-field">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password"
                       name="password_confirmation"
                       placeholder="Confirm your password"
                       required autocomplete="new-password">
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

        <!-- Right Registration Section -->
        <div class="register-right">

            <div class="register-form-header">
                <h1>Create Account</h1>
                <p>Fill in your details to get started.</p>
            </div>

            @if ($errors->any())
                <div class="register-message">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

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

                <div class="register-field">
                    <label for="email">Email Address</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required
                        autocomplete="username"
                    >
                </div>

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
                    Create Account <span>→</span>
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

    </div>

</x-guest-layout>