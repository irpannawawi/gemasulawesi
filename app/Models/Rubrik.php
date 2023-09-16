<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubrik extends Model
{
    use HasFactory;
    protected $table = 'rubrik'; // Nama tabel jika berbeda dari nama model
    protected $primaryKey = 'rubrik_id'; // Nama kunci utama jika berbeda

    protected $fillable = [
        'rubrik_id',
        'rubrik_name',
    ];
}
