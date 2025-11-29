<div>
    <form method="POST" action="/appointments">
        @csrf

        <p>
            <label for="name">Name:</label>

            <input type="text" id="name" name="name" value="{{ old('name') }}" />
        </p>

        <p>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" />
        </p>

        <p>
            <label for="scheduled_at">Scheduled at:</label>
            <input type="date" id="scheduled_at" name="scheduled_at" value="{{ old('scheduled_at') }}" />
        </p>

        <button type="submit">Submit</button>

        @if(session('status'))
            <div>{{ session('status') }}</div>
        @endif
    </form>
</div>

<style lang="css">
    label {
        display: inline-block;
        width: 90px;
    }
    input {
        width: 300px;
    }
</style>
