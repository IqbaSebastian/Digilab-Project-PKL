<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    protected $table = 'tb_penerbit';
    protected $primaryKey = 'kodePenerbit';
    public $timestamps = false;
}
