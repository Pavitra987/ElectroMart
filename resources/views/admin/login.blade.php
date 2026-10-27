<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ElectroMart | Admin Login</title>

  <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>

<body>

    <div class="login-container">

        <div class="left-section">

            <div class="logo">ElectroMart</div>

            <p>
                ADMINISTRATION PANEL
                <br><br>
                Manage products, categories, inventory
                and customer orders from one place.
            </p>

        </div>

        <div class="right-section">

            <h2>Welcome Back!</h2>

            <p class="subtitle">Sign in to your admin account.</p>

            @if ($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ url('/admin/login') }}" method="POST">

                @csrf

                <div class="input-group">

                    <label>Email Address</label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter admin email"
                        value="{{ old('email') }}"
                        required
                    >

                </div>

                <div class="input-group">

                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter password"
                        required
                    >

                </div>

                <button type="submit" class="login-btn">
                    Sign In
                </button>

            </form>

            <div class="footer">
                &copy; 2026 ElectroMart. All rights reserved.
            </div>

        </div>

    </div>

</body>
</html>