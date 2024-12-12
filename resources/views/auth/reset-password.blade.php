<x-guest-layout title="Reset Password">
    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <h1 class="text-center fs-5 fw-semibold mb-3">Reset Password</h1>

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                   placeholder="Masukkan email Anda" value="{{ old('email', $request->email) }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                   placeholder="Masukkan password baru" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                   id="password_confirmation" name="password_confirmation"
                   placeholder="Konfirmasi password baru Anda" required autocomplete="new-password">
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Tombol reset -->
        <div class="row justify-content-center mt-4">
            <button type="submit" class="btn btn-primary" style="width: 150px">Reset Password</button>
        </div>

        <!-- Link login -->
        <div class="text-center mt-4">
            <p class="text-muted">Ingat password? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </form>
</x-guest-layout>
