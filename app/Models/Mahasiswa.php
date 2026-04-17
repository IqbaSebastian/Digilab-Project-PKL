<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'tb_mahasiswa';
    protected $primaryKey = 'kodeMhs';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'username',
        'email',
        'jurusan'
    ];
}