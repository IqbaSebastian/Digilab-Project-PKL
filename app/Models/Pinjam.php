<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $table = 'tb_pinjam';
    protected $primaryKey = 'kodePinjam';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'kodePinjam',
        'kodePetugas',
        'kodePeminjam',
        'tipePeminjam',
        'tglPinjam',
        'tglKembali',
        'keterangan',
        'status',
    ];

    public function detail()
    {
        return $this->hasMany(PinjamDetail::class, 'kodePinjam', 'kodePinjam');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'kodePeminjam', 'kodeMhs');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'kodePeminjam', 'kodeDosen');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'kodePetugas', 'kodePetugas');
    }

    public function getNamaPeminjamAttribute()
    {
        if ($this->tipePeminjam == 2) {
            return $this->mahasiswa->nama ?? '-';
        } elseif ($this->tipePeminjam == 3) {
            return $this->dosen->nama ?? '-';
        }
        return '-';
    }

    public function getLabelStatusAttribute()
    {
        return $this->status == 1 ? 'Dipinjam' : 'Dikembalikan';
    }

    public function getLabelTipeAttribute()
    {
        return match((int)$this->tipePeminjam) {
            2 => 'Mahasiswa',
            3 => 'Dosen',
            default => 'Umum',
        };
    }
}