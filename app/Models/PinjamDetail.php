<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PinjamDetail extends Model
{
    protected $table = 'tb_pinjamdetail';
    protected $primaryKey = 'kodePinjamDetail';
    public $timestamps = false;

    protected $fillable = [
        'kodePinjam',
        'kodeBuku',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'kodeBuku', 'kodeBuku');
    }
}