<section class="mx-4">
    <header class="mb-4">
        <h2 class="card-title fs-5 mb-2 text-danger">
            {{ __('Hapus Akun') }}
        </h2>
        <p class="text-muted small">
            {{ __('Setelah akun Anda dihapus, semua data anda akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi yang ingin Anda simpan.') }}
        </p>
    </header>

    <button type="button" class="btn btn-danger" style="font-size: 0.9rem;" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
        <i class="fa-solid fa-trash-can"></i>&nbsp{{ __('Hapus Akun') }}
    </button>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}" class="mx-4 mb-1">
                    @csrf
                    @method('delete')
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">{{ __('Apakah Anda yakin ingin menghapus akun?') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        <p class="text-muted small">
                            {{ __('Setelah akun Anda dihapus, semua data anda akan dihapus secara permanen. Silakan masukkan password Anda untuk mengkonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.') }}
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" name="password" type="password" class="form-control">
                            @error('password', 'userDeletion')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" style="font-size: 0.9rem;" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i>&nbsp{{ __('Batal') }}</button>
                        <button type="submit" class="btn btn-danger" style="font-size: 0.9rem;"><i class="fa-solid fa-trash-can"></i>&nbsp{{ __('Hapus Akun') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>