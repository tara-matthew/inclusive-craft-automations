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
                    <td>{{ $appointment->customer->name }}</td>
                    <td>{{ $appointment->customer->email }}</td>
                    <td>{{ $appointment->scheduled_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $reminder?->send_at?->format('Y-m-d H:i') ?? '—' }}</td>
                    <td>{{ $reminder?->status?->value ?? '—' }}</td>
                    <td>
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
                    <td colspan="6">No appointments yet.</td>
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
        gap: 8px;
        align-items: center;
    }
    input {
        border-radius: 8px;
        border-color: #1a202c;
        border-width: 1px;
        border-style: solid;
        padding: 5px;
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
</style>
