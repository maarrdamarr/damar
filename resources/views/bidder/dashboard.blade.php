<x-sb-admin-layout>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-primary">Dashboard Pembeli</h1>
            <a href="{{ url('/#collection') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-shopping-cart fa-sm text-white mr-2"></i> Telusuri Koleksi
            </a>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Penawaran</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $bidsCount ?? '0' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-gavel fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Saldo Wallet</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format(Auth::user()->balance ?? 0) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-wallet fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Favorit</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $wishlistCount ?? '0' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-heart fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Lelang Dimenangkan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $winsCount ?? '0' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-trophy fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Lelang Terbaru</h6>
                        <a href="{{ url('/#collection') }}" class="small text-primary">Lihat semua</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Lot</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Sekarang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($auctions as $item)
                                        <tr>
                                            <td>#{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>Rp {{ number_format($item->current_bid ?? $item->start_price) }}</td>
                                            <td><a href="{{ route('bidder.auction.show', $item->id) }}" class="btn btn-sm btn-success">Lihat</a></td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4" class="text-center">Belum ada lelang tersedia.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Tindakan Cepat</h6>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('/#collection') }}" class="btn btn-primary btn-block mb-2">Mulai Menawar</a>
                        <a href="{{ route('bidder.wishlist.index') }}" class="btn btn-outline-primary btn-block mb-2">Wishlist Saya</a>
                        <a href="{{ route('bidder.wallet.index') }}" class="btn btn-outline-primary btn-block">Topup Saldo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-sb-admin-layout>