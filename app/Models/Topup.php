<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    use HasFactory;

    // Tambahkan baris ini agar semua kolom bisa diisi
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper untuk menentukan tipe transaksi
    public function getTypeAttribute()
    {
        // Jika status approved dan ada logika khusus, bisa tambah kolom type nanti
        // Untuk sekarang, semua topup dianggap sebagai "masuk" ke saldo user
        return 'credit';
    }
}
