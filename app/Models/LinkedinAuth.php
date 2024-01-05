<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkedinAuth extends Model
{
    use HasFactory;
    protected $table = 'linkedin_auths';

    protected $primaryKey = 'id';
    protected $fillable =
    [
        'id',
        'name',
        'email',
        'avatar',
        'user',
        'attributes',
        'token',
    ];
}
