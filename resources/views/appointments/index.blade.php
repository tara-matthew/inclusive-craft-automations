<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointments</title>
</head>
<body>

@include('partials.nav')

<div class="list-container">
    <h1>Appointments</h1>

    @if (session('status'))
        <div class="status">{{ session('status') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Customer</th>
                <th>Email</th>
                <th>Scheduled at</th>
                <th>Reminder due</th>
                <th>Reminder status</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($appointments as $appointment)
                @php
                    $reminder = $appointment->appointmentReminder;
                    $isFailedRow = (int) old('appointment_id') === $appointment->id;
                @endphp
                <tr>
                    <td data-label="Customer">{{ $appointment->customer->name }}</td>
                    <td data-label="Email">{{ $appointment->customer->email }}</td>
                    <td data-label="Scheduled at">{{ $appointment->scheduled_at->format('Y-m-d H:i') }}</td>
                    <td data-label="Reminder due">{{ $reminder?->send_at?->format('Y-m-d H:i') ?? '—' }}</td>
                    <td data-label="Reminder status">{{ $reminder?->status?->value ?? '—' }}</td>
                    <td data-label="Edit">
                        <form method="POST" action="{{ route('appointments.update', $appointment) }}" class="edit-form">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="appointment_id" value="{{ $appointment->id }}" />
                            <input
                                required
                                type="datetime-local"
                                name="scheduled_at"
                                value="{{ $isFailedRow ? old('scheduled_at') : $appointment->scheduled_at->format('Y-m-d\TH:i') }}"
                            />
                            <button type="submit">Update</button>
                        </form>

                        @if ($isFailedRow)
                            @error('scheduled_at')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-state">No appointments yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<style lang="css">
    body {
        font-family: Helvetica, serif;
        margin: 0;
    }
    .list-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
        box-sizing: border-box;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th,
    td {
        text-align: left;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        vertical-align: top;
    }
    .edit-form {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
    }
    input {
        border-radius: 8px;
        border-color: #1a202c;
        border-width: 1px;
        border-style: solid;
        padding: 5px;
        box-sizing: border-box;
    }
    input[type="datetime-local"] {
        -webkit-appearance: none;
        -moz-appearance: none;
        background-color: #fff;
        min-width: 0;
        flex: 1 1 auto;
    }
    button {
        border-radius: 10px;
        padding: 5px 10px;
        border-style: solid;
        border-width: 1px;
    }
    button:hover {
        cursor: pointer;
        background-color: gray;
    }
    .status {
        color: green;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .error {
        color: red;
        margin-top: 4px;
    }
    @media (max-width: 640px) {
        .list-container {
            margin: 20px auto;
        }
        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;
        }
        thead {
            display: none;
        }
        tbody tr {
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 8px 12px;
        }
        tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        tbody td:last-child {
            border-bottom: none;
        }
        tbody td::before {
            content: attr(data-label);
            font-weight: bold;
            flex-shrink: 0;
        }
        tbody td[data-label="Edit"] {
            flex-direction: column;
            align-items: stretch;
            gap: 6px;
        }
        tbody td[data-label="Edit"]::before {
            margin-bottom: 2px;
        }
        tbody td.empty-state {
            display: block;
            text-align: center;
            padding: 20px 0;
        }
        tbody td.empty-state::before {
            content: none;
        }
    }
</style>

</body>
</html>
