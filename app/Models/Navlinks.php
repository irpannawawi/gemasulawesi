<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Navlinks extends Model
{
    use HasFactory;
    protected $table = 'navigation_links';

    protected $primaryKey = 'nav_link_id';
    public $fillable = [
        'nav_link_id',
        'nav_id',
        'rubrik_id',
    ];

    public function rubrik(): HasOne
    {
        return $this->hasOne(Rubrik::class, 'rubrik_id', 'rubrik_id');
    }

    
    public function navigation(): HasMany
    {
        return $this->hasMany(Navigation::class, 'nav_id', 'nav_id');
    }
}
