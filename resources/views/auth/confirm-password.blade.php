<x-guest-layout title="Konfirmasi Password">
    <div class="mb-4 text-sm text-gray-600 text-center">
        {{ __('Ini adalah area yang aman dari aplikasi. Silakan konfirmasi password Anda sebelum melanjutkan.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <h1 class="text-center fs-5 fw-semibold mb-3">Konfirmasi Password</h1>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                   placeholder="Masukkan password Anda" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Tombol konfirmasi -->
        <div class="row justify-content-center mt-4">
            <button type="submit" class="btn btn-primary" style="width: 100px">Konfirmasi</button>
        </div>
    </form>
</x-guest-layout>