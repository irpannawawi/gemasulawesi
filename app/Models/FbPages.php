<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FbPages extends Model
{
    use HasFactory;
    protected $table = 'fb_pages';
    protected $key = 'id';
    protected $fillable = [
        'id',
        'name',
        'category',
        'category_list',
        'tasks',
        'access_token',
        'page_avatar',
        'instagram_id',
        'instagram_business_id',
        'instagram_username',
        'instagram_profile_pic',
    ];
}
