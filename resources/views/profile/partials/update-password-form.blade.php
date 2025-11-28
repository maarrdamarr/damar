<section>
    <header class="mb-4">
        <h2 class="h5 font-weight-bold text-gray-800">
            Update Password
        </h2>
        <p class="text-muted small">
            Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="current_password" class="text-gray-800 font-weight-bold small">Password Saat Ini</label>
            <input type="password" name="current_password" id="current_password" class="form-control" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="text-gray-800 font-weight-bold small">Password Baru</label>
            <input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
            @error('password', 'updatePassword')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="text-gray-800 font-weight-bold small">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-warning text-dark font-weight-bold">Ganti Password</button>

            @if (session('status') === 'password-updated')
                <span x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-success small ml-3 font-weight-bold">
                    <i class="fas fa-check"></i> Berhasil diganti.
                </span>
            @endif
        </div>
    </form>
</section>