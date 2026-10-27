<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | ElectroMart</title>


<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #f4f5f7;
        color: #222;
    }

    .topbar {
        background: #fff;
        padding: 20px 7%;
        border-bottom: 1px solid #e5e7eb;
    }

    .topbar h2 {
        margin: 0;
        font-size: 22px;
        letter-spacing: 1px;
        color: #203b32;
    }

    .topbar p {
        margin: 7px 0 0;
        font-size: 13px;
        color: #777;
    }

    .container {
        max-width: 850px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        margin-bottom: 25px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
    }

    .card-header {
        padding: 22px 25px;
        border-bottom: 1px solid #eee;
    }

    .card-header h3 {
        margin: 0;
        font-size: 18px;
        color: #203b32;
    }

    .card-header p {
        margin: 7px 0 0;
        font-size: 13px;
        color: #777;
    }

    .card-body {
        padding: 25px;
    }

    .card-body form {
        width: 100%;
    }

    .card-body input:not([type="checkbox"]):not([type="radio"]),
    .card-body textarea,
    .card-body select {
        display: block;
        width: 100%;
        max-width: 100%;
        padding: 12px;
        margin-top: 7px;
        margin-bottom: 18px;
        border: 1px solid #d5d9df;
        border-radius: 6px;
        background: #fff;
        font-size: 14px;
    }

    .card-body label {
        font-size: 13px;
        font-weight: 600;
        color: #444;
    }

    .card-body button {
        background: #203b32;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 12px 22px;
        font-size: 12px;
        font-weight: bold;
        cursor: pointer;
    }

    .card-body button:hover {
        background: #35654f;
    }

    .danger .card-header h3 {
        color: #b33b3b;
    }

    .danger .card-body button {
        background: #b33b3b;
    }

    .danger .card-body button:hover {
        background: #922d2d;
    }

    footer {
        text-align: center;
        padding: 15px;
        color: #999;
        font-size: 12px;
    }

    @media (max-width: 600px) {
        .container {
            margin: 25px auto;
        }

        .card-header,
        .card-body {
            padding: 18px;
        }
    }
</style>


</head>

<body>


<header class="topbar">
    <h2>ElectroMart</h2>
    <p>My Profile</p>
</header>

<main class="container">

    <section class="card">
        <div class="card-header">
            <h3>Profile Information</h3>
            <p>Update your name and email address.</p>
        </div>

        <div class="card-body">
            @include('profile.partials.update-profile-information-form')
        </div>
    </section>

    <section class="card">
        <div class="card-header">
            <h3>Password &amp; Security</h3>
            <p>Change your password to keep your account secure.</p>
        </div>

        <div class="card-body">
            @include('profile.partials.update-password-form')
        </div>
    </section>

    <section class="card danger">
        <div class="card-header">
            <h3>Delete Account</h3>
            <p>Permanently delete your account and associated data.</p>
        </div>

        <div class="card-body">
            @include('profile.partials.delete-user-form')
        </div>
    </section>

</main>

<footer>
    &copy; {{ date('Y') }} ElectroMart. All rights reserved.
</footer>


</body>
</html>
