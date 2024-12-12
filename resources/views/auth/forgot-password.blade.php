<x-guest-layout title="Lupa Password">
    <div class="mb-4 text-sm text-gray-600 text-center">
        {{ __('Lupa password Anda? Tidak masalah. Cukup berikan alamat email Anda dan kami akan mengirimkan link reset password yang memungkinkan Anda membuat password baru.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="alert alert-success fw-medium text-center mb-4" :status="session('status')"/>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <h1 class="text-center fs-5 fw-semibold mb-3">Reset Password</h1>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                   placeholder="Masukkan email Anda" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Tombol kirim -->
        <div class="row justify-content-center mt-4">
            <button type="submit" class="btn btn-primary" style="width: 250px">Kirim Link Reset Password</button>
        </div>

        <!-- Link login -->
        <div class="text-center mt-4">
            <p class="text-muted">Ingat password? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </form>
</x-guest-layout>
