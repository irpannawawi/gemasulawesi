<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XAuth extends Model
{
    use HasFactory;

    protected $table = 'x_auths';
    protected $key = 'id';
    protected $fillable = [
        'id',
        'nickname',
        'name',
        'user',
        'attributes',
        'token',
        'token_secret',
    ];
}
