<section class="mx-4">
    <header class="mb-4">
        <h2 class="card-title fs-5 mb-2">
            {{ __('Ubah Password') }}
        </h2>
        <p class="text-muted small">
            {{ __('Pastikan akun Anda menggunakan password yang panjang dan acak untuk keamanan.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mb-1">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">{{ __('Password Saat Ini') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control">
            @error('current_password', 'updatePassword')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">{{ __('Password Baru') }}</label>
            <input id="update_password_password" name="password" type="password" class="form-control">
            @error('password', 'updatePassword')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label">{{ __('Konfirmasi Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control">
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-circle-check"></i>&nbsp{{ __('Simpan') }}</button>

            {{-- @if (session('status') === 'password-updated')
                <div class="text-success small" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                    {{ __('Tersimpan.') }}
                </div>
            @endif --}}
        </div>
    </form>
</section>