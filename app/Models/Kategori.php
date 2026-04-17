<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'tb_kategori';
    protected $primaryKey = 'kodeKategori';
    public $timestamps = false;
}
