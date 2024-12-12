<x-guest-layout title="Verifikasi Email">
    <div class="text-center mb-4">
        <h1 class="fs-5 fw-semibold mb-3">Verifikasi Email</h1>
        <p class="text-muted">
            {{ __('Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik link yang baru saja kami kirimkan melalui email kepada Anda? Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkan email lainnya.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success fw-medium text-center mb-4">
            {{ __('Link verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
        </div>
    @endif

    <div class="row justify-content-center gap-2 mt-4">
        <div class="col-auto">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-primary">
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </button>
            </form>
        </div>

        <div class="col-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    {{ __('Logout') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>