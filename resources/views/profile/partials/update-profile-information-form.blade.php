<section class="mx-4">
    <header class="mb-4">
        <h2 class="card-title fs-5 mb-2">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="text-muted small">
            {{ __("Perbarui informasi profil dan alamat email akun Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4 mb-1">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Nama') }}</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus>
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-2 p-2">
                    <p class="small mb-0">
                        {{ __('Alamat email Anda belum diverifikasi.') }}
                        <button form="send-verification" class="btn btn-link btn-sm p-0 align-baseline">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-success" style="font-size: 0.9rem;"><i class="fa-solid fa-circle-check"></i>&nbsp;{{ __('Simpan') }}</button>

            {{-- @if (session('status') === 'profile-updated')
                <div class="text-success small" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                    {{ __('Tersimpan.') }}
                </div>
            @endif --}}
        </div>
    </form>
</section>