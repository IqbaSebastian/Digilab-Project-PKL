<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlists';

    protected $fillable = ['kodeUser', 'kodeBuku', 'role'];

    /**
     * Relasi ke Model Buku
     * Menghubungkan kolom kodeBuku di tabel wishlist dengan kodeBuku di tabel buku
     */
    public function buku()
    {
        // Parameter: (ModelTarget, foreign_key_di_wishlist, primary_key_di_buku)
        return $this->belongsTo(Buku::class, 'kodeBuku', 'kodeBuku');
    }
}