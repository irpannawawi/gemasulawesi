<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galery';

    protected $primaryKey = 'galery_id';
    public $fillable = [
        'galery_id',
        'galery_name',	
        'galery_description',	
        'galery_thumbnail',
        'created_at'
    ];


}
