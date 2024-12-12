<x-guest-layout title="Login">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h1 class="text-center fs-4 fw-semibold">Login</h1>

         <!-- Email Address -->
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" 
                   placeholder="Masukkan email Anda" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" 
                   class="form-control @error('password') is-invalid @enderror" id="password" name="password" 
                   placeholder="Masukkan password" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Ingat saya dan Lupa Password -->
        <div class="d-flex justify-content-between mt-3">
            <label for="remember_me">
                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                <span class="form-check-label" for="remember">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-muted">Lupa Password?</a>
            @endif
        </div>

        <!-- Tombol masuk -->
        <div class="row justify-content-center mt-4">
            <button type="submit" class="btn btn-primary" style="width: 100px">Masuk</button>
        </div>

        <!-- Link daftar -->
        <div class="text-center mt-4">
            <p class="text-muted">Belum punya akun? <a href="{{ route('register') }}">Register</a></p>
        </div>
    </form>
</x-guest-layout>