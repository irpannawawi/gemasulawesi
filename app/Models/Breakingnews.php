<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Breakingnews extends Model
{
    use HasFactory;

    protected $table = 'breaking_news';

    protected $primaryKey = 'breaking_news_id';
    public $fillable = [
        'breaking_news_id',
        'galery_id',	
        'post_id',	
        'title',	
        'url',	
    ];

    public function post(): HasOne
    {
        return $this->hasOne(Posts::class, 'post_id', 'post_id');
    }
}
