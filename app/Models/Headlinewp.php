<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Headlinewp extends Model
{
    use HasFactory;
    protected $table = 'headline_wp';

    protected $primaryKey = 'headline_wp_id';
    public $fillable = [
        'headline_wp_id',
        'post_id',	
    ];

    public function post(): HasOne
    {
        return $this->hasOne(Posts::class, 'post_id', 'post_id');
    }
}
