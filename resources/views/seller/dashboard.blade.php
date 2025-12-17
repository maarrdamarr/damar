<x-sb-admin-layout>
    <style>
        .seller-dashboard {
            --seller-forest: #1b4d3a;
            --seller-forest-dark: #0f3326;
            --seller-gold: #d1a846;
            --seller-gold-soft: rgba(209, 168, 70, 0.18);
            --seller-cream: #f8f1e4;
            --seller-ink: #1f2937;
            --seller-muted: #6b7280;
            font-family: "Nunito", sans-serif;
            color: var(--seller-ink);
            display: flex;
            flex-direction: column;
            gap: 1.75rem;
        }

        .seller-hero {
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr);
            gap: 1.5rem;
        }

        .seller-hero-main {
            position: relative;
            padding: 1.8rem;
            border-radius: 26px;
            background: #2563eb;
            color: #ffffff;
            overflow: hidden;
            box-shadow: 0 18px 36px rgba(15, 23, 42, 0.2);
        }

        .seller-hero-main::before {
            content: "";
            position: absolute;
            inset: 0;
            background: none;
            opacity: 0;
        }

        .seller-hero-main > * {
            position: relative;
            z-index: 1;
        }

        .seller-eyebrow {
            text-transform: uppercase;
            letter-spacing: 0.28em;
            font-size: 0.7rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.65);
        }

        .seller-title {
            margin: 0.4rem 0 0.35rem;
            font-size: clamp(1.7rem, 2.6vw, 2.4rem);
            font-weight: 700;
        }

        .seller-subtitle {
            margin: 0;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            max-width: 34rem;
        }

        .seller-hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1.4rem;
        }

        .seller-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 1.3rem;
            border-radius: 999px;
            border: 1px solid transparent;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.02em;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .seller-btn--gold {
            background: var(--seller-gold);
            color: #2a2212;
            box-shadow: 0 12px 24px rgba(209, 168, 70, 0.35);
        }

        .seller-btn--gold:hover {
            transform: translateY(-2px);
            color: #2a2212;
            box-shadow: 0 14px 26px rgba(209, 168, 70, 0.45);
            text-decoration: none;
        }

        .seller-btn--ghost {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.5);
            color: #ffffff;
        }

        .seller-btn--ghost:hover {
            color: #ffffff;
            text-decoration: none;
            transform: translateY(-2px);
        }

        .seller-btn--soft {
            background: #f9fafb;
            border-color: #e5e7eb;
            color: var(--seller-ink);
        }

        .seller-btn--soft:hover {
            color: var(--seller-ink);
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 10px 18px rgba(15, 23, 42, 0.12);
        }

        .seller-btn--sm {
            padding: 0.45rem 0.9rem;
            font-size: 0.75rem;
        }

        .seller-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 22px;
            padding: 1.5rem;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }

        .seller-hero-card {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .seller-balance-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            font-weight: 700;
            color: var(--seller-muted);
        }

        .seller-balance-value {
            font-size: clamp(1.7rem, 2.4vw, 2.3rem);
            font-weight: 700;
            color: var(--seller-forest);
        }

        .seller-hero-meta {
            display: grid;
            gap: 0.6rem;
            color: var(--seller-muted);
            font-size: 0.9rem;
        }

        .seller-hero-meta i {
            color: var(--seller-gold);
            margin-right: 0.4rem;
        }

        .seller-btn--dark {
            background: var(--seller-forest-dark);
            color: #ffffff;
            justify-content: center;
        }

        .seller-btn--dark:hover {
            color: #ffffff;
            transform: translateY(-2px);
            text-decoration: none;
        }

        .seller-metrics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 1rem;
        }

        .seller-metric {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .seller-metric-icon {
            width: 50px;
            height: 50px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            background: #f3f4f6;
            color: var(--seller-forest);
            flex-shrink: 0;
        }

        .seller-metric-icon--gold {
            background: var(--seller-gold-soft);
            color: var(--seller-gold);
        }

        .seller-metric-icon--mint {
            background: rgba(16, 185, 129, 0.15);
            color: #0f766e;
        }

        .seller-metric-icon--sky {
            background: rgba(59, 130, 246, 0.15);
            color: #2563eb;
        }

        .seller-metric-icon--rose {
            background: rgba(239, 68, 68, 0.12);
            color: #ef4444;
        }

        .seller-metric-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.16em;
            color: var(--seller-muted);
            font-weight: 700;
        }

        .seller-metric-value {
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .seller-section-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(0, 0.8fr);
            gap: 1.5rem;
        }

        .seller-card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.2rem;
        }

        .seller-card-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            font-weight: 700;
            color: var(--seller-ink);
        }

        .seller-card-sub {
            margin-top: 0.35rem;
            color: var(--seller-muted);
            font-size: 0.9rem;
        }

        .seller-action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .seller-action {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            padding: 0.9rem 1rem;
            border-radius: 18px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            text-decoration: none;
            color: var(--seller-ink);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .seller-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.12);
            background: #ffffff;
            text-decoration: none;
            color: var(--seller-ink);
        }

        .seller-action-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: var(--seller-gold-soft);
            color: var(--seller-gold);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .seller-action-label {
            font-weight: 700;
            font-size: 0.98rem;
        }

        .seller-action-desc {
            font-size: 0.82rem;
            color: var(--seller-muted);
        }

        .seller-note {
            background: linear-gradient(140deg, rgba(209, 168, 70, 0.15), rgba(27, 77, 58, 0.08));
            border: 1px solid rgba(209, 168, 70, 0.25);
        }

        .seller-note-title {
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 0.35rem;
        }

        .seller-note-list {
            margin: 0;
            padding-left: 1.2rem;
            color: var(--seller-muted);
            font-size: 0.9rem;
            display: grid;
            gap: 0.5rem;
        }

        .seller-table-wrap {
            overflow-x: auto;
        }

        .seller-table {
            width: 100%;
            border-collapse: collapse;
        }

        .seller-table th {
            text-align: left;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            color: #8b949e;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .seller-table td {
            padding: 0.9rem 0;
            border-bottom: 1px solid #eef2f7;
            color: var(--seller-ink);
            vertical-align: middle;
        }

        .seller-table tr:last-child td {
            border-bottom: none;
        }

        .seller-empty {
            text-align: center;
            color: #9ca3af;
            padding: 1.3rem 0;
        }

        .seller-badge {
            padding: 0.35rem 0.7rem;
            border-radius: 999px;
            font-weight: 600;
        }

        @media (max-width: 992px) {
            .seller-hero,
            .seller-section-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .seller-hero-actions {
                flex-direction: column;
            }

            .seller-btn--gold,
            .seller-btn--ghost {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="seller-dashboard">
        <header class="seller-hero">
            <div class="seller-hero-main">
                <div class="seller-eyebrow">Ringkas Penjual</div>
                <h1 class="seller-title">Dashboard Penjual</h1>
                <p class="seller-subtitle">
                    Selamat datang, {{ Auth::user()->name }}. Kelola lelang, pantau penawaran, dan tingkatkan reputasi toko Anda.
                </p>
                <div class="seller-hero-actions">
                    <a href="{{ route('seller.items.create') }}" class="seller-btn seller-btn--gold">
                        <i class="fas fa-upload"></i>
                        Upload Barang
                    </a>
                    <a href="{{ route('seller.items.index') }}" class="seller-btn seller-btn--ghost">
                        <i class="fas fa-box-open"></i>
                        Kelola Barang
                    </a>
                </div>
            </div>

            <div class="seller-card seller-hero-card">
                <div>
                    <div class="seller-balance-label">Saldo Penjual</div>
                    <div class="seller-balance-value">Rp {{ number_format(Auth::user()->balance ?? 0, 0, ',', '.') }}</div>
                </div>
                <div class="seller-hero-meta">
                    <div><i class="fas fa-envelope"></i>{{ $unreadMessages }} pesan belum dibaca</div>
                    <div><i class="fas fa-gavel"></i>{{ $openItems }} lelang aktif</div>
                    <div><i class="fas fa-check-circle"></i>{{ $paidItems }} lelang terbayar</div>
                </div>
                <a href="{{ route('messages.index') }}" class="seller-btn seller-btn--dark">
                    Buka Pesan
                </a>
            </div>
        </header>

        <section class="seller-metrics">
            <div class="seller-card seller-metric">
                <div class="seller-metric-icon seller-metric-icon--gold">
                    <i class="fas fa-boxes"></i>
                </div>
                <div>
                    <div class="seller-metric-label">Total Barang</div>
                    <div class="seller-metric-value">{{ $totalItems }}</div>
                </div>
            </div>
            <div class="seller-card seller-metric">
                <div class="seller-metric-icon seller-metric-icon--mint">
                    <i class="fas fa-broadcast-tower"></i>
                </div>
                <div>
                    <div class="seller-metric-label">Lelang Aktif</div>
                    <div class="seller-metric-value">{{ $openItems }}</div>
                </div>
            </div>
            <div class="seller-card seller-metric">
                <div class="seller-metric-icon seller-metric-icon--rose">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div>
                    <div class="seller-metric-label">Menunggu Bayar</div>
                    <div class="seller-metric-value">{{ $pendingPayment }}</div>
                </div>
            </div>
            <div class="seller-card seller-metric">
                <div class="seller-metric-icon seller-metric-icon--sky">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <div>
                    <div class="seller-metric-label">Terbayar</div>
                    <div class="seller-metric-value">{{ $paidItems }}</div>
                </div>
            </div>
            <div class="seller-card seller-metric">
                <div class="seller-metric-icon">
                    <i class="fas fa-gavel"></i>
                </div>
                <div>
                    <div class="seller-metric-label">Penawaran Masuk</div>
                    <div class="seller-metric-value">{{ $bidsCount }}</div>
                </div>
            </div>
        </section>

        <section class="seller-section-grid">
            <div class="seller-card">
                <div class="seller-card-head">
                    <div>
                        <div class="seller-card-title">Aksi Cepat</div>
                        <div class="seller-card-sub">Masuk ke fitur utama tanpa berpindah jauh.</div>
                    </div>
                </div>
                <div class="seller-action-grid">
                    <a href="{{ route('seller.items.create') }}" class="seller-action">
                        <span class="seller-action-icon"><i class="fas fa-plus"></i></span>
                        <span>
                            <span class="seller-action-label">Tambah Barang</span><br>
                            <span class="seller-action-desc">Mulai lelang baru</span>
                        </span>
                    </a>
                    <a href="{{ route('seller.items.index') }}" class="seller-action">
                        <span class="seller-action-icon"><i class="fas fa-box-open"></i></span>
                        <span>
                            <span class="seller-action-label">Kelola Lelang</span><br>
                            <span class="seller-action-desc">Ubah status dan data</span>
                        </span>
                    </a>
                    <a href="{{ route('messages.index') }}" class="seller-action">
                        <span class="seller-action-icon"><i class="fas fa-envelope"></i></span>
                        <span>
                            <span class="seller-action-label">Pesan Masuk</span><br>
                            <span class="seller-action-desc">Balas calon pembeli</span>
                        </span>
                    </a>
                    <a href="{{ route('support.my') }}" class="seller-action">
                        <span class="seller-action-icon"><i class="fas fa-headset"></i></span>
                        <span>
                            <span class="seller-action-label">Support</span><br>
                            <span class="seller-action-desc">Butuh bantuan cepat</span>
                        </span>
                    </a>
                </div>
            </div>

            <div class="seller-card seller-note">
                <div class="seller-note-title">Checklist Lelang</div>
                <ul class="seller-note-list">
                    <li>Gunakan foto terang dari berbagai sudut.</li>
                    <li>Tulis deskripsi singkat namun detail.</li>
                    <li>Tentukan harga awal yang realistis.</li>
                    <li>Balas pesan pembeli dalam 24 jam.</li>
                </ul>
            </div>
        </section>

        <section class="seller-card">
            <div class="seller-card-head">
                <div>
                    <div class="seller-card-title">Barang Terbaru</div>
                    <div class="seller-card-sub">Pantau performa barang yang baru Anda unggah.</div>
                </div>
                <a href="{{ route('seller.items.index') }}" class="seller-btn seller-btn--soft">
                    Lihat Semua
                </a>
            </div>
            <div class="seller-table-wrap">
                <table class="seller-table">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>Status</th>
                            <th>Penawaran</th>
                            <th>Batas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentItems as $item)
                            <tr>
                                <td>
                                    <div class="font-weight-bold">{{ $item->name }}</div>
                                    <small class="text-muted">Harga awal Rp {{ number_format($item->start_price, 0, ',', '.') }}</small>
                                </td>
                                <td>
                                    <span class="badge seller-badge badge-{{ $item->status === 'open' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td>{{ $item->bids_count }}</td>
                                <td>{{ $item->ends_at ? $item->ends_at->format('d M Y') : '-' }}</td>
                                <td>
                                    <a href="{{ route('seller.items.edit', $item->id) }}" class="seller-btn seller-btn--soft seller-btn--sm">
                                        Kelola
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="seller-empty">
                                    Belum ada barang. Mulai lelang pertama Anda hari ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-sb-admin-layout>
