<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $table = 'source'; // Nama tabel jika berbeda dari nama model
    protected $primaryKey = 'source_id'; // Nama kunci utama jika berbeda

    protected $fillable = [
        'source_id',
        'source_name',
        'source_alias',
        'source_website',
        'source_logo_url',
    ];
}
