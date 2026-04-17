<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'tb_dosen';
    protected $primaryKey = 'kodeDosen';
    public $timestamps = false;

    protected $fillable = ['nama', 'username', 'email'];
}