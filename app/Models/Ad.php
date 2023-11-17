<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ad extends Model
{
    protected $fillable = [
        'title',
        'value',
        'type',
        'position',
    ];

    protected $primaryKey ='ads_id';
}

