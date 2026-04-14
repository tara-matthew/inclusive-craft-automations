<div class="form-container">
    <form method="POST" action="{{ route('pin.verify') }}">
        @csrf
        <div class="form-group">
            <label for="pin">
                PIN:
                <span class="required">*</span>
            </label>
            <input required type="password" id="pin" name="pin" inputmode="numeric" class="@error('pin') is-invalid @enderror" />

            @error('pin')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div style="text-align: center;">
            <button type="submit">Verify</button>
        </div>
    </form>
</div>

<style lang="css">
    body {
        font-family: Helvetica, serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
    }
    .form-group {
        margin-bottom: 40px;
        position: relative;
        display: flex;
        justify-content: space-between;
    }
    label {
        display: inline-block;
        width: 150px;
    }
    input {
        width: 300px;
        border-radius: 8px;
        border-color: #1a202c;
        border-width: 1px;
        border-style: solid;
        padding: 5px;
    }
    .form-container {
        padding: 20px;
        width: 25%;
        border: 1px solid grey;
        border-radius: 16px;
    }
    .required {
        color: red;
    }
    .error {
        color: red;
        position: absolute;
        top: 34px;
    }
    button {
        border-radius: 10px;
        padding: 10px;
        border-style: solid;
        border-width: 1px;
        width: 100px;
    }
    button:hover {
        cursor: pointer;
        background-color: gray;
    }
</style>

