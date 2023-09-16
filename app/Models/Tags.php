<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;
    protected $table = 'tags'; // Nama tabel jika berbeda dari nama model
    protected $primaryKey = 'tag_id'; // Nama kunci utama jika berbeda

    protected $fillable = [
        'tag_id',
        'tag_name',
        'tag_link',
    ];
}
