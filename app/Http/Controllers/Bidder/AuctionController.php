<?php

namespace App\Http\Controllers\Bidder;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AuctionController extends Controller
{
    // 1. Katalog Barang (Hanya yang statusnya OPEN)
    public function index()
    {
        $items = Item::where('status', 'open')->with('user')->latest()->get();
        return view('bidder.auction.index', compact('items'));
    }

    // 2. Detail Barang & Form Bid
    public function show($id)
    {
        $item = Item::with(['bids.user', 'user'])->findOrFail($id);
        
        // Ambil tawaran tertinggi saat ini
        $highestBid = $item->bids()->max('bid_amount') ?? $item->start_price;

        return view('bidder.auction.show', compact('item', 'highestBid'));
    }

    // 3. Proses Simpan Tawaran (Bidding)
    public function store(Request $request, $id)
    {
        $request->validate([
            'bid_amount' => 'required|numeric',
        ]);

        $item = Item::findOrFail($id);

        // Cek 1: Apakah lelang masih buka?
        if($item->status !== 'open') {
            return back()->with('error', 'Lelang sudah ditutup!');
        }

        // Cek 2: Tentukan harga minimal (Highest Bid vs Start Price)
        $currentHighest = $item->bids()->max('bid_amount') ?? $item->start_price;

        // Validasi: Tawaran harus lebih tinggi dari harga sekarang
        if ($request->bid_amount <= $currentHighest) {
            return back()->with('error', 'Tawaran harus lebih tinggi dari Rp ' . number_format($currentHighest));
        }

        // Cek 3: Apakah user punya cukup saldo?
        $user = User::find(Auth::id());

        // Jika user sebelumnya sudah memasang bid di item ini, itu akan dikembalikan
        $userPreviousBid = $item->bids()->where('user_id', $user->id)->orderByDesc('bid_amount')->first();
        $refundable = $userPreviousBid ? $userPreviousBid->bid_amount : 0;

        if (($user->balance + $refundable) < $request->bid_amount) {
            return back()->with('error', 'Saldo tidak cukup! Saldo Anda: Rp ' . number_format($user->balance));
        }

        // Ambil bid tertinggi saat ini untuk dikembalikan ke pemiliknya (jika berbeda dengan penawar sekarang)
        $previousHighestBid = $item->bids()->orderByDesc('bid_amount')->first();

        // Lakukan perubahan keuangan dan penyimpanan bid dalam transaksi
        DB::transaction(function() use ($previousHighestBid, $user, $request, $item) {
            // Jika ada previous highest bid
            if ($previousHighestBid) {
                // Jika pemilik previous highest adalah penawar saat ini, kembalikan dulu bid lama ke saldo mereka
                if ($previousHighestBid->user_id == $user->id) {
                    $user->balance += $previousHighestBid->bid_amount;
                } else {
                    // Refund ke user sebelumnya
                    $prevUser = User::find($previousHighestBid->user_id);
                    if ($prevUser) {
                        $prevUser->balance += $previousHighestBid->bid_amount;
                        $prevUser->save();
                    }
                }
            }

            // Potong saldo user saat ini untuk bid baru
            $user->balance -= $request->bid_amount;
            $user->save();

            // Simpan Bid
            Bid::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
                'bid_amount' => $request->bid_amount,
            ]);
        });

        // Anti-sniping: if bid placed within anti-sniping window, extend ends_at
        if ($item->ends_at) {
            $window = (int) \App\Models\Setting::get('auction.anti_sniping_window_minutes', 5);
            $extension = (int) \App\Models\Setting::get('auction.anti_sniping_extension_minutes', 5);

            $remainingSeconds = $item->ends_at->getTimestamp() - now()->getTimestamp();
            if ($remainingSeconds > 0 && $remainingSeconds <= ($window * 60)) {
                $item->ends_at = $item->ends_at->addMinutes($extension);
                $item->save();
            }
        }

        return back()->with('success', 'Penawaran berhasil! Saldo terpotong Rp ' . number_format($request->bid_amount));
    }
}
