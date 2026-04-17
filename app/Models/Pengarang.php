<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    protected $table = 'tb_pengarang';
    protected $primaryKey = 'kodePengarang';
    public $timestamps = false;
}
