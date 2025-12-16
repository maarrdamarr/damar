<section>
    <header class="mb-4">
        <h2 class="h5 font-weight-bold text-danger">
            Hapus Akun
        </h2>
        <p class="text-muted small">
            Setelah akun dihapus, semua data dan aset Anda akan hilang permanen. Tindakan ini tidak dapat dibatalkan. Harap unduh data penting sebelum melanjutkan.
        </p>
    </header>

    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteAccountModal">
        <i class="fas fa-trash-alt mr-2"></i>Hapus Akun Saya
    </button>

    <!-- Delete Account Confirmation Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content border-danger">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header bg-danger text-white border-danger">
                        <h5 class="modal-title" id="deleteAccountModalLabel">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Konfirmasi Penghapusan Akun
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <p class="font-weight-bold text-gray-900 mb-3">Apakah Anda yakin ingin menghapus akun Anda?</p>
                        <div class="alert alert-warning small mb-3" role="alert">
                            <strong>Perhatian:</strong> Tindakan ini tidak dapat dibatalkan. Semua data, transaksi, dan informasi pribadi Anda akan dihapus secara permanen.
                        </div>

                        <div class="form-group">
                            <label for="password" class="font-weight-bold mb-2">Masukkan Password Anda untuk Konfirmasi</label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="form-control form-control-sm @error('password', 'userDeletion') is-invalid @enderror" 
                                placeholder="Password" 
                                required
                                autocomplete="off">
                            @error('password', 'userDeletion')
                                <small class="invalid-feedback d-block">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-check mr-1"></i>Ya, Hapus Akun Secara Permanen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>