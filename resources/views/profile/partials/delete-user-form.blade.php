<section>
    <header class="mb-4">
        <h2 class="h5 font-weight-bold text-danger">
            Hapus Akun
        </h2>
        <p class="text-muted small">
            Setelah akun dihapus, semua data dan aset Anda akan hilang permanen. Harap unduh data penting sebelum melanjutkan.
        </p>
    </header>

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAccountModal">
        Hapus Akun Saya
    </button>

    <div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteAccountModalLabel">Konfirmasi Penghapusan</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <h6 class="font-weight-bold text-gray-900">Apakah Anda yakin ingin menghapus akun?</h6>
                        <p class="text-muted small">
                            Tindakan ini tidak dapat dibatalkan. Masukkan password Anda untuk mengonfirmasi bahwa Anda benar-benar ingin menghapus akun ini.
                        </p>

                        <div class="form-group mt-3">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password Anda" required>
                            @error('password', 'userDeletion')
                                <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Ya, Hapus Permanen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>