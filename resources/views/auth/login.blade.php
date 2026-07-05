<x-guest-layout>
    <h2 class="h4 mb-4 text-center">Login</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-check mb-3">
            <input id="remember_me" class="form-check-input" type="checkbox" name="remember">
            <label class="form-check-label" for="remember_me">Remember me</label>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
            @endif
            <button type="submit" class="btn btn-primary">Login</button>
        </div>

        <p class="text-center mb-0">
            Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none">Register</a>
        </p>
    </form>
</x-guest-layout>
