<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'tb_buku';
    protected $primaryKey = 'kodeBuku';
    public $incrementing = false;      // ← tambahkan
    protected $keyType = 'string';     // ← tambahkan
    public $timestamps = false;

    // ← tambahkan method ini
    public function getRouteKeyName()
    {
        return 'kodeBuku';
    }

    protected $fillable = [
    'judul',
    'kodePenerbit',
    'kodePengarang',
    'tahun',
    'edisi',
    'seri',
    'abstraksi',
    'image',      
    'kodeKategori'
];

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'kodePenerbit');
    }

    public function pengarang()
    {
        return $this->belongsTo(Pengarang::class, 'kodePengarang');
    }
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kodeKategori');
    }
}