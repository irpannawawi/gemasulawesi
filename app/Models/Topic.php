<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $table = 'topics';

    protected $primaryKey = 'topic_id';
    public $fillable = [
        'topic_id',
        'topic_name',	
        'topic_description',	
        'topic_image',	
    ];
    public function rubrik(): HasOne
    {
        return $this->hasOne(Rubrik::class, 'rubrik_id', 'rubrik_id');
    }
    public function post(): HasOne
    {
        return $this->hasOne(Posts::class, 'post_id', 'post_id');
    }
}
