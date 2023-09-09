<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Posts extends Model
{
    use HasFactory;
    protected $table = 'posts';

    protected $primaryKey = 'post_id';
    public $fillable = [
        'post_id',
        'title',
        'slug',
        'category',
        'description',
        'article',
        'allow_comment',
        'view_in_welcome_page',
        'author_id',
        'editor_id',
        'status'
    ];

    public function editor(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'editor_id');
    }
    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
}
