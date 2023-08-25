<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    use HasFactory;
    protected $table = 'assets';

    protected $primaryKey = 'asset_id';
    public $fillable = [
        'asset_id',
        'file_name',	
    ];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'asset_id', 'asset_id');
    }
}
