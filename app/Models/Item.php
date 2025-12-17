<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

        protected $guarded = [];

        protected $casts = [
            'ends_at' => 'datetime',
        ];

        /**
         * Close this auction: mark closed, determine winner and process payment.
         */
        public function close()
        {
            if ($this->status === 'closed') return false;

            $this->status = 'closed';
            $this->save();

            $winningBid = $this->highestBid();
            if ($winningBid) {
                $winner = $winningBid->user;
                $seller = $this->user;

                $seller->balance += $winningBid->bid_amount;
                $seller->save();

                \App\Models\Topup::create([
                    'user_id' => $seller->id,
                    'amount' => $winningBid->bid_amount,
                    'status' => 'approved',
                ]);
            }

            return true;
        }

        // Barang milik satu user (Seller)
        public function user() {
            return $this->belongsTo(User::class);
        }

        // Barang punya banyak tawaran (Bids)
        public function bids() {
            return $this->hasMany(Bid::class)->orderBy('bid_amount', 'desc');
        }
        
        // Helper untuk mengambil tawaran tertinggi
        public function highestBid() {
            return $this->bids()->first();
    }
    public function wishlists() {
        return $this->hasMany(Wishlist::class);
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }

    public function comments() { return $this->hasMany(Comment::class)->latest(); }
public function review() { return $this->hasOne(Review::class); }
}
