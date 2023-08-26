<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Video extends Model
{
    use HasFactory;
    protected $table = 'videos';

    protected $primaryKey = 'video_id';
    public $fillable = [
        'video_id',
        'uploader_id',
        'url',	
        'title',	
        'description',	
        'credit',	
    ];



    public function uploader(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'uploader_id');
    }
}
