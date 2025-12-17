<x-sb-admin-layout>
    <style>
        .wallet-dashboard {
            --wallet-primary: #2853C8;
            --wallet-primary-dark: #0c5d56;
            --wallet-primary-soft: rgba(15, 118, 110, 0.12);
            font-family: "Public Sans", "Segoe UI", sans-serif;
            color: #2f2b3d;
            display: flex;
            flex-direction: column;
            gap: 1.8rem;
        }

        .wallet-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .wallet-eyebrow {
            text-transform: uppercase;
            letter-spacing: 0.3em;
            font-size: 0.7rem;
            color: #8c93a3;
            font-weight: 700;
        }

        .wallet-title {
            font-size: clamp(1.6rem, 2.4vw, 2.2rem);
            margin: 0.4rem 0 0.3rem;
            font-weight: 700;
            color: #2f2b3d;
        }

        .wallet-subtitle {
            margin: 0;
            color: #6b7280;
            font-size: 0.95rem;
        }

        .wallet-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 1.25rem;
            border-radius: 999px;
            border: 1px solid transparent;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.02em;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .wallet-btn--primary {
            background: var(--wallet-primary);
            color: #ffffff;
            box-shadow: 0 12px 24px rgba(15, 118, 110, 0.25);
        }

        .wallet-btn--primary:hover {
            transform: translateY(-2px);
            color: #ffffff;
            box-shadow: 0 14px 26px rgba(15, 118, 110, 0.3);
            text-decoration: none;
        }

        .wallet-btn--light {
            background: rgba(255, 255, 255, 0.22);
            border-color: rgba(255, 255, 255, 0.4);
            color: #ffffff;
        }

        .wallet-btn--outline-light {
            background: transparent;
            border-color: rgba(255, 255, 255, 0.6);
            color: #ffffff;
        }

        .wallet-btn--soft {
            background: var(--wallet-primary-soft);
            color: var(--wallet-primary);
            border-color: rgba(15, 118, 110, 0.25);
            padding: 0.45rem 0.9rem;
            font-size: 0.75rem;
        }

        .wallet-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(0, 1fr);
            gap: 1.5rem;
        }

        .wallet-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 22px;
            padding: 1.6rem;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }

        .wallet-balance {
            background: var(--wallet-primary);
            color: #ffffff;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .wallet-balance::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.08);
        }

        .wallet-balance > * {
            position: relative;
            z-index: 1;
        }

        .wallet-balance-top {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .wallet-icon-pill {
            width: 52px;
            height: 52px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.2);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .wallet-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 600;
        }

        .wallet-value {
            font-size: clamp(1.8rem, 2.6vw, 2.6rem);
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .wallet-balance-meta {
            margin-top: 0.85rem;
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.95rem;
        }

        .wallet-balance-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1.2rem;
        }

        .wallet-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.8rem;
            margin-top: 1.4rem;
        }

        .wallet-stat {
            background: rgba(255, 255, 255, 0.16);
            padding: 0.75rem;
            border-radius: 14px;
        }

        .wallet-stat-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 600;
        }

        .wallet-stat-value {
            font-size: 1.2rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .wallet-card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .wallet-card-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.16em;
            font-weight: 700;
            color: #2f2b3d;
        }

        .wallet-card-sub {
            margin-top: 0.35rem;
            color: #6b7280;
            font-size: 0.9rem;
        }

        .wallet-link {
            color: var(--wallet-primary);
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
        }

        .wallet-link:hover {
            color: var(--wallet-primary-dark);
            text-decoration: none;
        }

        .wallet-action-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
        }

        .wallet-action {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            padding: 0.9rem 1rem;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            text-decoration: none;
            color: #2f2b3d;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .wallet-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.12);
            background: #ffffff;
            text-decoration: none;
            color: #2f2b3d;
        }

        .wallet-action-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: var(--wallet-primary-soft);
            color: var(--wallet-primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .wallet-action-text {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .wallet-action-label {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .wallet-action-desc {
            font-size: 0.8rem;
            color: #6b7280;
        }

        .wallet-table-wrap {
            overflow-x: auto;
        }

        .wallet-table {
            width: 100%;
            border-collapse: collapse;
        }

        .wallet-table th {
            text-align: left;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #8c93a3;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .wallet-table td {
            padding: 0.9rem 0;
            border-bottom: 1px solid #eef2f7;
            color: #2f2b3d;
            vertical-align: middle;
        }

        .wallet-table tr:last-child td {
            border-bottom: none;
        }

        .wallet-empty {
            text-align: center;
            color: #9ca3af;
            padding: 1.2rem 0;
        }

        @media (max-width: 992px) {
            .wallet-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .wallet-header {
                align-items: flex-start;
            }

            .wallet-btn--primary {
                width: 100%;
                justify-content: center;
            }

            .wallet-action-grid {
                grid-template-columns: 1fr;
            }

            .wallet-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 480px) {
            .wallet-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="wallet-dashboard">
        <header class="wallet-header">
            <div>
                <div class="wallet-eyebrow">Ringkas Dompet</div>
                <h1 class="wallet-title">Dashboard Pembeli</h1>
                <p class="wallet-subtitle">Saldo, aktivitas, dan lelang terbaru dalam satu tampilan.</p>
            </div>
            <a href="{{ route('bidder.auction.index') }}" class="wallet-btn wallet-btn--primary">
                <i class="fas fa-search"></i>
                Jelajahi Lelang
            </a>
        </header>

        <section class="wallet-grid">
            <div class="wallet-card wallet-balance">
                <div class="wallet-balance-top">
                    <div class="wallet-icon-pill">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div>
                        <div class="wallet-label">Saldo Wallet</div>
                        <div class="wallet-value">Rp {{ number_format(Auth::user()->balance ?? 0) }}</div>
                    </div>
                </div>
                <div class="wallet-balance-meta">Saldo aktif untuk menawar dan pembayaran.</div>
                <div class="wallet-balance-actions">
                    <a href="{{ route('bidder.wallet.index') }}" class="wallet-btn wallet-btn--light">
                        <i class="fas fa-plus"></i>
                        Topup
                    </a>
                    <a href="{{ route('bidder.wins.index') }}" class="wallet-btn wallet-btn--outline-light">
                        <i class="fas fa-trophy"></i>
                        Menang Saya
                    </a>
                </div>
                <div class="wallet-stats">
                    <div class="wallet-stat">
                        <div class="wallet-stat-label">Penawaran</div>
                        <div class="wallet-stat-value">{{ $bidsCount ?? '0' }}</div>
                    </div>
                    <div class="wallet-stat">
                        <div class="wallet-stat-label">Favorit</div>
                        <div class="wallet-stat-value">{{ $wishlistCount ?? '0' }}</div>
                    </div>
                    <div class="wallet-stat">
                        <div class="wallet-stat-label">Menang</div>
                        <div class="wallet-stat-value">{{ $winsCount ?? '0' }}</div>
                    </div>
                </div>
            </div>

            <div class="wallet-card">
                <div class="wallet-card-head">
                    <div>
                        <div class="wallet-card-title">Aksi Cepat</div>
                        <div class="wallet-card-sub">Masuk ke fitur utama tanpa berpindah jauh.</div>
                    </div>
                </div>
                <div class="wallet-action-grid">
                    <a href="{{ route('bidder.auction.index') }}" class="wallet-action">
                        <span class="wallet-action-icon"><i class="fas fa-gavel"></i></span>
                        <span class="wallet-action-text">
                            <span class="wallet-action-label">Mulai Menawar</span>
                            <span class="wallet-action-desc">Lihat lelang aktif</span>
                        </span>
                    </a>
                    <a href="{{ route('bidder.wishlist.index') }}" class="wallet-action">
                        <span class="wallet-action-icon"><i class="fas fa-heart"></i></span>
                        <span class="wallet-action-text">
                            <span class="wallet-action-label">Wishlist Saya</span>
                            <span class="wallet-action-desc">Koleksi favorit</span>
                        </span>
                    </a>
                    <a href="{{ route('messages.index') }}" class="wallet-action">
                        <span class="wallet-action-icon"><i class="fas fa-envelope"></i></span>
                        <span class="wallet-action-text">
                            <span class="wallet-action-label">Pesan</span>
                            <span class="wallet-action-desc">Pantau percakapan</span>
                        </span>
                    </a>
                    <a href="{{ route('support.my') }}" class="wallet-action">
                        <span class="wallet-action-icon"><i class="fas fa-headset"></i></span>
                        <span class="wallet-action-text">
                            <span class="wallet-action-label">Support</span>
                            <span class="wallet-action-desc">Butuh bantuan cepat</span>
                        </span>
                    </a>
                </div>
            </div>
        </section>

        <section class="wallet-card">
            <div class="wallet-card-head">
                <div>
                    <div class="wallet-card-title">Lelang Terbaru</div>
                    <div class="wallet-card-sub">Pantau lot yang baru saja dibuka.</div>
                </div>
                <a href="{{ route('bidder.auction.index') }}" class="wallet-link">Lihat semua</a>
            </div>
            <div class="wallet-table-wrap">
                <table class="wallet-table">
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
                                <td>
                                    <a href="{{ route('bidder.auction.show', $item->id) }}" class="wallet-btn wallet-btn--soft">Lihat</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="wallet-empty">Belum ada lelang tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-sb-admin-layout>
