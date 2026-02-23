<div class="form-container">
    <form method="POST" action="/appointments">
        @csrf
        <div>
        <div class="form-group">
            <label for="name">
                Name:
                <span class="required">*</span>
            </label>
            <input required type="text" id="name" name="name" value="{{ old('name') }}" class="@error('name') is-invalid @enderror" />

            @error('name')
            <div class="error">{{$message}}</div>
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
            <div class="error">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="scheduled_at">
                Scheduled at:
                <span class="required">*</span>
            </label>
            <input required type="datetime-local" id="scheduled_at" name="scheduled_at" value="{{ old('scheduled_at') }}" class="@error('scheduled_at') is-invalid @enderror" />

            @error('scheduled_at')
                <div class="error">{{$message}}</div>
            @enderror
         </div>
        </div>


        <div style="text-align: center;">
            <button type="submit">Submit</button>
        </div>

        @if(session('status'))
            <div style="margin-top:20px"><strong>{{ session('status') }}</strong></div>
        @endif


    </form>
</div>

<style lang="css">
    body {
        font-family: Helvetica, serif;
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
        margin-left: auto;
        margin-right: auto;
        margin-top: 200px;
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
