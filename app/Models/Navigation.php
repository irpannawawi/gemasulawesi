<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Navigation extends Model
{
    use HasFactory;
    protected $table = 'navigation';

    protected $primaryKey = 'nav_id';
    public $fillable = [
        'nav_id',
        'nav_name',
        'order_priority',
        'nav_type',
    ];

    public function navlinks(): HasMany
    {
        return $this->hasMany(Navlinks::class, 'nav_id', 'nav_id');
    }

}
