
@extends('layouts.customer')

@section('title', 'Contact Us')

@section('content')

<style>
    .contact-section {
        background: #f2f2f2;
        padding: 60px 20px;
        min-height: 75vh;
    }

    .contact-wrapper {
        max-width: 1150px;
        margin: auto;
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 30px;
        align-items: start;
    }

    .contact-container,
    .company-contact-box {
        background: #ffffff;
        padding: 35px;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07);
    }

    .contact-container h2 {
        text-align: center;
        font-size: 32px;
        font-weight: 700;
        color: #111111;
        margin-bottom: 10px;
    }

    .contact-container .subtitle {
        text-align: center;
        color: #777777;
        margin-bottom: 35px;
        font-size: 15px;
        line-height: 1.6;
    }

    .contact-container label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #222222;
    }

    .contact-container input,
    .contact-container textarea {
        width: 100%;
        padding: 13px 15px;
        border: 1px solid #d0d0d0;
        border-radius: 6px;
        margin-bottom: 22px;
        background: #fafafa;
        color: #222222;
        font-size: 14px;
        box-sizing: border-box;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .contact-container input:focus,
    .contact-container textarea:focus {
        outline: none;
        border-color: #333333;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.06);
    }

    .contact-container textarea {
        min-height: 160px;
        resize: vertical;
    }

    .contact-submit {
        width: 100%;
        padding: 14px;
        background: #171717;
        color: #ffffff;
        border: 1px solid #171717;
        border-radius: 6px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, color 0.2s;
    }

    .contact-submit:hover {
        background: #444444;
        border-color: #444444;
    }

    .contact-alert {
        padding: 13px 15px;
        margin-bottom: 22px;
        border-radius: 6px;
        font-size: 14px;
    }

    .contact-success {
        background: #eeeeee;
        color: #222222;
        border: 1px solid #cccccc;
    }

    .contact-error {
        background: #f5f5f5;
        color: #222222;
        border: 1px solid #bdbdbd;
    }

    /* Company contact information */
    .company-contact-box h3 {
        font-size: 24px;
        font-weight: 700;
        color: #111111;
        margin: 0 0 10px;
    }

    .company-contact-description {
        color: #777777;
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 30px;
    }

    .company-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 20px 0;
        border-bottom: 1px solid #eeeeee;
    }

    .company-contact-item:last-child {
        border-bottom: none;
    }

    .contact-icon {
        width: 43px;
        height: 43px;
        min-width: 43px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f0f0f0;
        border-radius: 8px;
        color: #171717;
        font-size: 20px;
    }

    .company-contact-item h4 {
        font-size: 15px;
        font-weight: 700;
        color: #222222;
        margin: 0 0 7px;
    }

    .company-contact-item p,
    .company-contact-item a {
        font-size: 14px;
        line-height: 1.7;
        color: #666666;
        margin: 0;
        text-decoration: none;
        overflow-wrap: anywhere;
    }

    .company-contact-item a:hover {
        color: #111111;
        text-decoration: underline;
    }

    .contact-note {
        background: #f5f5f5;
        border-radius: 7px;
        padding: 15px;
        margin-top: 20px;
        font-size: 13px;
        line-height: 1.7;
        color: #666666;
    }

    @media (max-width: 800px) {
        .contact-wrapper {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .contact-section {
            padding: 30px 15px;
        }

        .contact-container,
        .company-contact-box {
            padding: 25px 20px;
        }

        .contact-container h2 {
            font-size: 26px;
        }

        .company-contact-box h3 {
            font-size: 22px;
        }
    }
</style>

<section class="contact-section">

    <div class="contact-wrapper">

        {{-- Contact Form --}}
        <div class="contact-container">

            <h2>Contact Us</h2>

            <p class="subtitle">
                Facing an issue? Tell us about it, and our team will look into it.
            </p>

            @if(session('success'))
                <div class="contact-alert contact-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="contact-alert contact-error">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST">
                @csrf

                <label for="name">Full Name</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', auth()->user()->name ?? '') }}"
                    placeholder="Enter your full name"
                    required
                >

                <label for="email">Email Address</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', auth()->user()->email ?? '') }}"
                    placeholder="Enter your email address"
                    required
                >

                <label for="complaint">Describe Your Issue</label>

                <textarea
                    id="complaint"
                    name="complaint"
                    placeholder="Explain the issue you faced..."
                    required
                >{{ old('complaint') }}</textarea>

                <button type="submit" class="contact-submit">
                    Submit Complaint
                </button>

            </form>

        </div>

        {{-- Company Contact Information --}}
        <div class="company-contact-box">

            <h3>Company Information</h3>

            <p class="company-contact-description">
                Have questions about your order, products, or delivery?
                Get in touch with our team.
            </p>

            <div class="company-contact-item">

                <div class="contact-icon">✉</div>

                <div>
                    <h4>Email Address</h4>

                    <a href="mailto:support@electromart.com">
                        support@electromart.com
                    </a>
                </div>

            </div>

            <div class="company-contact-item">

                <div class="contact-icon">☎</div>

                <div>
                    <h4>Phone Number</h4>

                    <a href="tel:+919876543210">
                        +91 98765 43210
                    </a>
                </div>

            </div>

            <div class="company-contact-item">

                <div class="contact-icon">⌖</div>

                <div>
                    <h4>Office Address</h4>

                    <p>
                        ElectroMart<br>
                        Kochi, Kerala, India
                    </p>
                </div>

            </div>

            <div class="company-contact-item">

                <div class="contact-icon">◷</div>

                <div>
                    <h4>Working Hours</h4>

                    <p>
                        Monday – Saturday<br>
                        9:00 AM – 6:00 PM
                    </p>
                </div>

            </div>

            <div class="contact-note">
                <strong>Need help?</strong><br>
                Submit your complaint using the form, and provide enough
                details for our team to understand the issue.
            </div>

        </div>

    </div>

</section>

@endsection
