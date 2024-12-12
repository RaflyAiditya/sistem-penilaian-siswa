<x-guest-layout title="Register">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h1 class="text-center fs-4 fw-semibold">Register</h1>

        <!-- Name -->
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                   placeholder="Masukkan nama Anda" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                   placeholder="Masukkan email Anda" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
                <div class="input-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                    placeholder="Masukkan password" required autocomplete="new-password">
                    <button class="btn btn-outline-secondary" type="button" style="border: 1px solid #ced4da;" id="togglePassword">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation"
                        placeholder="Konfirmasi password Anda" required autocomplete="new-password">
                        <button class="btn btn-outline-secondary" type="button" style="border: 1px solid #ced4da;" id="togglePasswordConfirmation">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                </div> 
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Tombol register -->
        <div class="row justify-content-center mt-4">
            <button type="submit" class="btn btn-success" style="width: 100px">Daftar</button>
        </div>

        <!-- Link login -->
        <div class="text-center mt-4">
            <p class="text-muted">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </form>
</x-guest-layout>