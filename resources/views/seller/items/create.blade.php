<x-sb-admin-layout>
    <h1 class="h3 mb-4 text-gray-800">Upload Barang Antik</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('seller.items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi & Kondisi Barang</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label>Harga Awal (Open Bid)</label>
                    <input type="number" name="start_price" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Foto Barang</label>
                    <input type="file" name="image" class="form-control-file">
                </div>

                <button type="submit" class="btn btn-primary">Simpan & Mulai Lelang</button>
                <a href="{{ route('seller.items.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</x-sb-admin-layout>