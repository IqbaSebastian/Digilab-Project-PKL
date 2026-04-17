<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'tb_petugas';
    protected $primaryKey = 'kodePetugas';
    public $timestamps = false;

    protected $fillable = ['nama', 'username', 'email'];
}