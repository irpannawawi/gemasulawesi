<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FbAuth extends Model
{
    use HasFactory;
    protected $table = 'facebook_auth';
    protected $key = 'id';
    protected $fillable = [
        'id',
        'name',
        'email',
        'avatar',
        'attributes',
        'token',
    ];
}
