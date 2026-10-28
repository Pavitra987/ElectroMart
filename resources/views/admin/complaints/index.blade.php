@extends('admin.layouts.app')

@section('title', 'Complaints | ElectroMart')

@section('content')

<style>
    .complaints-page {
        padding: 25px;
        background: #f5f5f5;
        min-height: 80vh;
    }

    .complaints-header {
        margin-bottom: 25px;
    }

    .complaints-header h2 {
        color: #171717;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .complaints-header p {
        color: #777;
        margin: 0;
    }

    .complaints-card {
        background: #fff;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow-x: auto;
    }

    .complaints-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 700px;
    }

    .complaints-table th {
        background: #222;
        color: #fff;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
    }

    .complaints-table td {
        padding: 15px;
        border-bottom: 1px solid #e5e5e5;
        color: #333;
        vertical-align: middle;
    }

    .complaints-table tr:hover td {
        background: #fafafa;
    }

    .complaint-email {
        color: #444;
        text-decoration: none;
    }

    .complaint-email:hover {
        color: #000;
        text-decoration: underline;
    }

    .resolved-checkbox {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #222;
    }

    .resolved-label {
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .complaint-status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-pending {
        background: #eee;
        color: #333;
    }

    .status-resolved {
        background: #222;
        color: #fff;
    }

    .complaints-alert {
        padding: 12px 15px;
        margin-bottom: 20px;
        background: #eaeaea;
        color: #222;
        border-radius: 6px;
    }

    .no-complaints {
        text-align: center;
        padding: 40px 15px;
        color: #777;
    }
</style>

<div class="complaints-page">


<div class="complaints-header">
    <h2>Customer Complaints</h2>
    <p>View customer issues and update their resolution status.</p>
</div>

@if(session('success'))
    <div class="complaints-alert">
        {{ session('success') }}
    </div>
@endif

<div class="complaints-card">

    @if($complaints->isEmpty())

        <div class="no-complaints">
            <h5>No complaints yet</h5>
            <p>Customer complaints will appear here when submitted.</p>
        </div>

    @else

        <table class="complaints-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Complaint</th>
                    <th>Customer Email</th>
                    <th>Status</th>
                    <th>Resolved</th>
                </tr>
            </thead>

            <tbody>
                @foreach($complaints as $complaint)
                    <tr>
                        <td>{{ $complaint->id }}</td>

                        <td style="max-width: 350px; overflow-wrap: anywhere;">
                            {{ $complaint->complaint }}
                        </td>

                        <td>
                            <a class="complaint-email"
                               href="mailto:{{ $complaint->email }}">
                                {{ $complaint->email }}
                            </a>
                        </td>

                        <td>
                            @if($complaint->is_resolved)
                                <span class="complaint-status status-resolved">
                                    Resolved
                                </span>
                            @else
                                <span class="complaint-status status-pending">
                                    Pending
                                </span>
                            @endif
                        </td>

                        <td>
                            <form action="{{ route('admin.complaints.toggleResolved', $complaint->id) }}"
                                  method="POST">
                                @csrf
                                @method('PATCH')

                                <label class="resolved-label">
                                    <input
                                        type="checkbox"
                                        class="resolved-checkbox"
                                        {{ $complaint->is_resolved ? 'checked' : '' }}
                                        onchange="this.form.submit()"
                                    >
                                    <span>
                                        {{ $complaint->is_resolved ? 'Done' : 'Mark resolved' }}
                                    </span>
                                </label>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif

</div>


</div>


@endsection