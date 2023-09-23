<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Headlinerubrik extends Model
{
    use HasFactory;
    protected $table = 'headline';

    protected $primaryKey = 'headline_id';
    public $fillable = [
        'headline_id',
        'rubrik_id',	
        'post_id',	
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
