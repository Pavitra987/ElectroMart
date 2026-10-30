
@extends('layouts.customer')

@section('title', 'Edit Profile')

@section('content')

<style>
    /* Profile page container */
    .profile-page {
        max-width: 850px;
        width: 100%;
        margin: 40px auto;
        padding: 0 20px;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
        color: #222;
    }

    .profile-page *,
    .profile-page *::before,
    .profile-page *::after {
        box-sizing: border-box;
    }

    /* Profile cards */
    .profile-page .profile-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        margin-bottom: 25px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
    }

    /* Card header */
    .profile-page .profile-card-header {
        padding: 22px 25px;
        border-bottom: 1px solid #eee;
    }

    .profile-page .profile-card-header h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
        color: #203b32;
    }

    .profile-page .profile-card-header p {
        margin: 7px 0 0;
        font-size: 14px;
        color: #777;
    }

    /* Card content */
    .profile-page .profile-card-body {
        padding: 25px;
    }

    .profile-page .profile-card-body form {
        width: 100%;
    }

    /* Form labels */
    .profile-page .profile-card-body label {
        display: block;
        margin-bottom: 7px;
        font-size: 14px;
        font-weight: 600;
        color: #444;
    }

    /* Form inputs */
    .profile-page .profile-card-body input:not([type="checkbox"]):not([type="radio"]),
    .profile-page .profile-card-body textarea,
    .profile-page .profile-card-body select {
        display: block;
        width: 100%;
        max-width: 100%;
        padding: 12px;
        margin-top: 7px;
        margin-bottom: 18px;
        border: 1px solid #d5d9df;
        border-radius: 6px;
        background: #fff;
        color: #222;
        font-family: inherit;
        font-size: 14px;
    }

    .profile-page .profile-card-body input:focus,
    .profile-page .profile-card-body textarea:focus,
    .profile-page .profile-card-body select:focus {
        outline: none;
        border-color: #203b32;
        box-shadow: 0 0 0 2px rgba(32, 59, 50, 0.12);
    }

    /* General buttons */
    .profile-page .profile-card-body button {
        background: #203b32;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 12px 22px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    .profile-page .profile-card-body button:hover {
        background: #35654f;
    }

    /* Saved address */
    .profile-page .saved-address {
        padding: 18px;
        margin: 18px 0;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        flex-wrap: wrap;
    }

    .profile-page .saved-address-details {
        flex: 1;
        min-width: 200px;
    }

    .profile-page .saved-address-details h4 {
        margin: 0 0 12px;
        color: #203b32;
        font-size: 16px;
    }

    .profile-page .saved-address-details p {
        margin: 7px 0;
        color: #555;
        font-size: 14px;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }

    .profile-page .default-badge {
        display: inline-block;
        margin-left: 7px;
        padding: 4px 9px;
        border-radius: 5px;
        background: #203b32;
        color: #fff;
        font-size: 11px;
        font-weight: 600;
        vertical-align: middle;
    }

    .profile-page .address-actions {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .profile-page .address-actions form {
        width: auto;
    }

    .profile-page .profile-card-body .address-actions button {
        padding: 9px 12px;
        white-space: nowrap;
    }

    .profile-page .profile-card-body .address-actions .delete-address-btn {
        background: #b33b3b;
    }

    .profile-page .profile-card-body .address-actions .delete-address-btn:hover {
        background: #922d2d;
    }

    /* Add address */
    .profile-page .add-address-section {
        margin-top: 20px;
        border-top: 1px solid #eee;
        padding-top: 18px;
    }

    .profile-page .add-address-section summary {
        cursor: pointer;
        font-weight: 600;
        font-size: 15px;
        color: #203b32;
        padding: 8px 0;
    }

    .profile-page .add-address-section summary:hover {
        color: #35654f;
    }

    .profile-page .address-form {
        margin-top: 20px;
    }

    .profile-page .address-form .address-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0 18px;
    }

    .profile-page .address-form .address-form-grid .full-width {
        grid-column: 1 / -1;
    }

    .profile-page .address-form .default-option {
        display: flex;
        align-items: center;
        gap: 9px;
        margin: 5px 0 18px;
    }

    .profile-page .address-form .default-option input {
        margin: 0;
    }

    .profile-page .profile-card-body .save-address-btn {
        background: #203b32;
    }

    .profile-page .profile-card-body .save-address-btn:hover {
        background: #35654f;
    }

    /* Alerts and validation */
    .profile-page .address-alert {
        padding: 12px 15px;
        margin-bottom: 18px;
        border-radius: 6px;
        font-size: 14px;
    }

    .profile-page .address-alert.success {
        background: #e8f5ed;
        color: #21663b;
        border: 1px solid #c5e5cf;
    }

    .profile-page .address-alert.error {
        background: #fff0f0;
        color: #a12626;
        border: 1px solid #f1c5c5;
    }

    .profile-page .field-error {
        display: block;
        margin-top: -12px;
        margin-bottom: 12px;
        color: #b33b3b;
        font-size: 12px;
    }

    /* Delete account section */
    .profile-page .profile-danger .profile-card-header h3 {
        color: #b33b3b;
    }

    .profile-page .profile-danger .profile-card-body button {
        background: #b33b3b;
    }

    .profile-page .profile-danger .profile-card-body button:hover {
        background: #922d2d;
    }

    /* Responsive layout */
    @media (max-width: 600px) {
        .profile-page {
            margin: 25px auto;
            padding: 0 15px;
        }

        .profile-page .profile-card-header,
        .profile-page .profile-card-body {
            padding: 18px;
        }

        .profile-page .address-form .address-form-grid {
            grid-template-columns: 1fr;
        }

        .profile-page .address-form .address-form-grid .full-width {
            grid-column: auto;
        }

        .profile-page .address-actions {
            flex-direction: row;
            flex-wrap: wrap;
        }
    }
</style>

<main class="profile-page">

    {{-- Display success message --}}
    @if(session('success'))
        <div class="address-alert success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Display validation errors --}}
    @if($errors->any())
        <div class="address-alert error">
            Please correct the errors in the form below.
        </div>
    @endif

    {{-- Profile Information --}}
    <section class="profile-card">

        <div class="profile-card-header">
            <h3>Profile Information</h3>
            <p>Update your name and email address.</p>
        </div>

        <div class="profile-card-body">
            @include('profile.partials.update-profile-information-form')
        </div>

    </section>

    {{-- Saved Addresses --}}
    <section class="profile-card">

        <div class="profile-card-header">
            <h3>Saved Addresses</h3>
            <p>Manage your delivery addresses for faster checkout.</p>
        </div>

        <div class="profile-card-body">

            {{-- Display existing addresses --}}
            @forelse($addresses as $address)

                <div class="saved-address">

                    <div class="saved-address-details">

                        <h4>
                            {{ $address->label }}

                            @if($address->is_default)
                                <span class="default-badge">Default</span>
                            @endif
                        </h4>

                        <p>
                            <strong>{{ $address->recipient_name }}</strong>
                        </p>

                        <p>{{ $address->phone }}</p>

                        <p>{{ $address->email }}</p>

                        <p>
                            {{ $address->address_line }},
                            {{ $address->city }},
                            {{ $address->state }} -
                            {{ $address->postal_code }}
                        </p>

                    </div>

                    <div class="address-actions">

                        {{-- Set default address --}}
                        @if(!$address->is_default)
                            <form action="{{ route('addresses.default', $address->id) }}"
                                  method="POST">
                                @csrf
                                @method('PATCH')

                                <button type="submit">
                                    Set as Default
                                </button>
                            </form>
                        @endif

                        {{-- Delete address --}}
                        <form action="{{ route('addresses.destroy', $address->id) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this address?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="delete-address-btn">
                                Delete
                            </button>
                        </form>

                    </div>

                </div>

            @empty

                <p>You haven't saved any addresses yet.</p>
                <p>Add your first address below. It will automatically become your default address.</p>

            @endforelse

            {{-- Add New Address --}}
            <details class="add-address-section"
                {{ $errors->any() ? 'open' : '' }}>

                <summary>+ Add New Address</summary>

                <form action="{{ route('addresses.store') }}"
                      method="POST"
                      class="address-form">

                    @csrf

                    <div class="address-form-grid">

                        {{-- Label --}}
                        <div>
                            <label for="label">Address Label</label>

                            <input type="text"
                                   id="label"
                                   name="label"
                                   placeholder="Home, Work, etc."
                                   value="{{ old('label', 'Home') }}"
                                   required>

                            @error('label')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Recipient --}}
                        <div>
                            <label for="recipient_name">Recipient Name</label>

                            <input type="text"
                                   id="recipient_name"
                                   name="recipient_name"
                                   value="{{ old('recipient_name', auth()->user()->name) }}"
                                   required>

                            @error('recipient_name')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label for="phone">Phone Number</label>

                            <input type="tel"
                                   id="phone"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   required>

                            @error('phone')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email">Email</label>

                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email', auth()->user()->email) }}"
                                   required>

                            @error('email')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Address --}}
                        <div class="full-width">
                            <label for="address_line">Full Address</label>

                            <textarea id="address_line"
                                      name="address_line"
                                      rows="3"
                                      required>{{ old('address_line') }}</textarea>

                            @error('address_line')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- City --}}
                        <div>
                            <label for="city">City</label>

                            <input type="text"
                                   id="city"
                                   name="city"
                                   value="{{ old('city') }}"
                                   required>

                            @error('city')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- State --}}
                        <div>
                            <label for="state">State</label>

                            <input type="text"
                                   id="state"
                                   name="state"
                                   value="{{ old('state') }}"
                                   required>

                            @error('state')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Postal code --}}
                        <div>
                            <label for="postal_code">Postal Code</label>

                            <input type="text"
                                   id="postal_code"
                                   name="postal_code"
                                   value="{{ old('postal_code') }}"
                                   required>

                            @error('postal_code')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    {{-- Default option --}}
                    <label class="default-option">
                        <input type="checkbox"
                               name="is_default"
                               value="1"
                               {{ old('is_default') ? 'checked' : '' }}>

                        Set as default address
                    </label>

                    <button type="submit" class="save-address-btn">
                        Save Address
                    </button>

                </form>

            </details>

        </div>

    </section>

    {{-- Password and Security --}}
    <section class="profile-card">

        <div class="profile-card-header">
            <h3>Password &amp; Security</h3>
            <p>Change your password to keep your account secure.</p>
        </div>

        <div class="profile-card-body">
            @include('profile.partials.update-password-form')
        </div>

    </section>

    {{-- Delete Account --}}
    <section class="profile-card profile-danger">

        <div class="profile-card-header">
            <h3>Delete Account</h3>
            <p>Permanently delete your account and associated data.</p>
        </div>

        <div class="profile-card-body">
            @include('profile.partials.delete-user-form')
        </div>

    </section>

</main>

@endsection
