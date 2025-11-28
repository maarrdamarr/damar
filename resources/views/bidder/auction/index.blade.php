<x-sb-admin-layout>
    <h1 class="h3 mb-4 text-gray-800">Bursa Lelang</h1>

    <div class="row">
        @foreach($items as $item)
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div style="height: 200px; overflow: hidden; background: #f8f9fa;">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" style="object-fit: cover; height: 100%; width: 100%;">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100 text-muted">No Image</div>
                    @endif
                </div>
                
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">{{ $item->name }}</h5>
                    <p class="card-text text-truncate">{{ $item->description }}</p>
                    <p class="text-primary font-weight-bold">Mulai: Rp {{ number_format($item->start_price) }}</p>
                    <small class="text-muted">Penjual: {{ $item->user->name }}</small>
                </div>
                <div class="card-footer bg-white border-top-0">
                    <a href="{{ route('bidder.auction.show', $item->id) }}" class="btn btn-primary btn-block">
                        Lihat & Tawar <i class="fas fa-gavel"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-sb-admin-layout>