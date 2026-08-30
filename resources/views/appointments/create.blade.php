<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Appointment</title>
</head>
<body>

@include('partials.nav')

<div class="page-content">
    <div class="form-container">
        <form method="POST" action="/appointments">
            @csrf
            <div>
                <div class="form-group">
                    <label for="name">
                        Name:
                        <span class="required">*</span>
                    </label>
                    <input
                        required
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        class="@error('name') is-invalid @enderror"
                    />

                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="secondary_name">Secondary Name:</label>
                    <input type="text" id="secondary_name" name="secondary_name" value="{{ old('secondary_name') }}" />
                </div>

                <div class="form-group">
                    <label for="email">
                        Email:
                        <span class="required">*</span>
                    </label>
                    <input required type="email" id="email" name="email" value="{{ old('email') }}" />

                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="scheduled_at">
                        Scheduled at:
                        <span class="required">*</span>
                    </label>
                    <input
                        required
                        type="datetime-local"
                        id="scheduled_at"
                        name="scheduled_at"
                        value="{{ old('scheduled_at') }}"
                        class="@error('scheduled_at') is-invalid @enderror"
                    />

                    @error('scheduled_at')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div style="text-align: center">
                <button type="submit">Submit</button>
            </div>

            @if (session('status'))
                <div style="margin-top: 20px"><strong>{{ session('status') }}</strong></div>
            @endif
        </form>
    </div>
</div>

<style lang="css">
    body {
        font-family: Helvetica, serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
    }
    .page-content {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        box-sizing: border-box;
    }
    .form-group {
        margin-bottom: 24px;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    label {
        display: inline-block;
    }
    input {
        width: 100%;
        box-sizing: border-box;
        border-radius: 8px;
        border-color: #1a202c;
        border-width: 1px;
        border-style: solid;
        padding: 12px;
        font-size: 16px;
        min-height: 44px;
    }
    .form-container {
        padding: 20px;
        width: 100%;
        max-width: 420px;
        box-sizing: border-box;
        border: 1px solid grey;
        border-radius: 16px;
    }
    .required {
        color: red;
    }
    .error {
        color: red;
        margin-top: 2px;
    }
    button {
        border-radius: 10px;
        padding: 12px 28px;
        border-style: solid;
        border-width: 1px;
        min-width: 100px;
        min-height: 44px;
        font-size: 16px;
    }
    button:hover {
        cursor: pointer;
        background-color: gray;
    }
    @media (max-width: 480px) {
        .page-content {
            padding: 0;
            align-items: stretch;
        }
        .form-container {
            flex: 1;
            max-width: none;
            border: none;
            border-radius: 0;
            padding: 32px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-group {
            margin-bottom: 32px;
        }
        label {
            font-size: 18px;
        }
    }
</style>

</body>
</html>
