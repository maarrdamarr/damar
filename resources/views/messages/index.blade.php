<x-sb-admin-layout>
    <h1 class="h3 mb-4 text-gray-800">Pesan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Percakapan</h6>
        </div>
        <div class="card-body p-0">
            @if($messages->count() > 0)
                @if(Auth::user()->role === 'seller')
                    <div class="list-group list-group-flush">
                        @foreach($messages as $message)
                            @php
                                $itemId = $message->item_id;
                                $buyerId = $message->sender_id;
                                $sender = $message->sender;
                                $senderName = $sender->name ?? 'Pengguna';
                                $senderEmail = $sender->email ?? '-';
                                $role = $sender->role ?? 'user';
                                $avatar = $sender->avatar ?? null;
                                $avatarUrl = $avatar
                                    ? (\Illuminate\Support\Str::startsWith($avatar, ['http://', 'https://']) ? $avatar : asset('storage/' . $avatar))
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($senderName) . '&background=random';
                                $itemName = $message->item->name ?? $message->item->nama_barang ?? '-';
                                $snippet = \Illuminate\Support\Str::limit($message->message ?? $message->pesan ?? '', 70);
                            @endphp
                            <a href="{{ route('messages.conversation', ['itemId' => $itemId, 'buyerId' => $buyerId]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $avatarUrl }}" class="rounded-circle mr-3" style="width: 40px; height: 40px; object-fit: cover;">
                                    <div>
                                        <h6 class="mb-0 font-weight-bold">{{ $senderName }}</h6>
                                        <small class="text-muted">{{ $senderEmail }}</small>
                                        <div class="text-xs text-gray-500 mt-1">{{ $itemName }} - {{ $snippet }}</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="badge badge-{{ $role == 'seller' ? 'info' : ($role == 'bidder' ? 'primary' : 'secondary') }} mb-1">
                                        {{ ucfirst($role) }}
                                    </span>
                                    <br>
                                    <small class="text-xs text-gray-500">{{ $message->created_at->format('d/m/Y H:i') }}</small>
                                    <br>
                                    <small class="text-xs text-gray-500">Klik untuk balas <i class="fas fa-chevron-right ml-1"></i></small>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Pengirim</th>
                                    <th>Barang</th>
                                    <th>Pesan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $message)
                                <tr>
                                    <td>{{ $message->sender->name }}</td>
                                    <td>{{ $message->item->nama_barang ?? $message->item->name ?? '-' }}</td>
                                    <td>{{ $message->pesan ?? $message->message ?? '-' }}</td>
                                    <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @php
                                            $itemId = $message->item_id;
                                            $buyerId = $message->sender_id;
                                        @endphp
                                        <a href="{{ route('messages.conversation', ['itemId' => $itemId, 'buyerId' => $buyerId]) }}" class="btn btn-sm btn-primary mr-2">
                                            <i class="fas fa-reply"></i> Balas
                                        </a>
                                        {{-- Toggle inline reply form --}}
                                        <button class="btn btn-sm btn-outline-secondary" data-toggle="collapse" data-target="#replyForm-{{ $message->id }}" aria-expanded="false" aria-controls="replyForm-{{ $message->id }}">
                                            <i class="fas fa-comment-medical"></i> Balas Cepat
                                        </button>
                                    </td>
                                </tr>
                                <tr class="collapse" id="replyForm-{{ $message->id }}">
                                    <td colspan="5">
                                        <form action="{{ route('messages.store', $itemId) }}" method="POST" class="form-inline">
                                            @csrf
                                            <input type="hidden" name="buyer_id" value="{{ $buyerId }}">
                                            <div class="input-group w-100">
                                                <input type="text" name="message" class="form-control form-control-sm" placeholder="Tulis balasan untuk {{ $message->sender->name }}..." required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-success" type="submit">
                                                        <i class="fas fa-paper-plane"></i> Kirim
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @else
                <p class="text-center py-4 mb-0">Belum ada pesan.</p>
            @endif
        </div>
    </div>
</x-sb-admin-layout>
