<!-- resources/views/auth/login.blade.php -->

<form method="POST" action="{{ url('/login') }}">
    @csrf

    <div>
        <label for="username">Username</label>
        <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>
    </div>

    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
    </div>

    <div>
        <button type="submit">Login</button>
    </div>

    @error('username')
        <div>{{ $message }}</div>
    @enderror
</form>
