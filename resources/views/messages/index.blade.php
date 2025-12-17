<x-sb-admin-layout>
    <h1 class="h3 mb-4 text-gray-800">Pesan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pesan</h6>
        </div>
        <div class="card-body">
            @if($messages->count() > 0)
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
                                <td>{{ $message->item->nama_barang ?? $message->item->name ?? '—' }}</td>
                                <td>{{ $message->pesan ?? $message->message ?? '—' }}</td>
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
            @else
                <p class="text-center mt-4">Belum ada pesan.</p>
            @endif
        </div>
    </div>
</x-sb-admin-layout>
