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
        'status',
        'tags',
        'related_articles',
        'topics',
        'schedul_time',
        'published_at',
        'is_deleted',
        'post_image',
        'origin_id',
    ];

    public function editor(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'editor_id');
    }
    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function rubrik(): HasOne
    {
        return $this->hasOne(Rubrik::class, 'rubrik_id', 'category');
    }

    public function image(): HasOne
    {
        return $this->hasOne(Image::class, 'image_id', 'post_image');
    }
}
