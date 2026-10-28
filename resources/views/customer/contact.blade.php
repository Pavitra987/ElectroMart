@extends('layouts.customer')

@section('content')

<style>
    .contact-section {
        background: #f2f2f2;
        padding: 60px 20px;
        min-height: 75vh;
    }

    .contact-container {
        max-width: 750px;
        margin: auto;
        background: #ffffff;
        padding: 40px;
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

    @media (max-width: 576px) {
        .contact-section {
            padding: 30px 15px;
        }

        .contact-container {
            padding: 25px 20px;
        }

        .contact-container h2 {
            font-size: 26px;
        }
    }
</style>


<section class="contact-section">
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


</section>

@endsection
