<?php
namespace App\Http\Controllers;
use App\Models\Topup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    // BIDDER: Halaman Dompet
    public function index() {
        $topups = Topup::where('user_id', Auth::id())->latest()->get();
        return view('bidder.wallet.index', compact('topups'));
    }

    // BIDDER: Request Topup
    public function store(Request $request) {
        $request->validate(['amount' => 'required|numeric|min:10000']);
        Topup::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'status' => 'pending'
        ]);
        return back()->with('success', 'Permintaan top-up dikirim. Tunggu konfirmasi Admin.');
    }

    // ADMIN: Halaman Approval Topup
    public function adminIndex() {
        $topups = Topup::with('user')->where('status', 'pending')->latest()->get();
        return view('admin.wallet.index', compact('topups'));
    }

    // ADMIN: History Semua Transaksi Saldo (Topup + Pembayaran Lelang)
    public function adminHistory() {
        $transactions = Topup::with('user')->latest()->get();
        return view('admin.wallet.history', compact('transactions'));
    }

    // ADMIN: Approve Topup
    public function approve($id) {
        $topup = Topup::findOrFail($id);
        $topup->update(['status' => 'approved']);
        
        // Tambah saldo user
        $user = User::find($topup->user_id);
        $user->balance += $topup->amount;
        $user->save();

        return back()->with('success', 'Top-up disetujui, saldo user bertambah.');
    }
    // ADMIN: Tambah Saldo Manual ke User Tertentu
    public function manualTopup(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $user = User::findOrFail($id);

        // 1. Tambah ke History Topup (Status langsung Approved)
        Topup::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'status' => 'approved', // Langsung sukses
        ]);

        // 2. Update Saldo User
        $user->balance += $request->amount;
        $user->save();

        return back()->with('success', 'Berhasil menambahkan Rp ' . number_format($request->amount) . ' ke saldo ' . $user->name);
    }
}
