<?php

namespace App\Http\Controllers\Bidder;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Simpan Bid
        Bid::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'bid_amount' => $request->bid_amount,
        ]);

        return back()->with('success', 'Penawaran berhasil dikirim!');
    }
}