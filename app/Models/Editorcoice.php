<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Editorcoice extends Model
{
    use HasFactory;

    protected $table = 'editor_choice';

    protected $primaryKey = 'editor_choice_id';
    public $fillable = [
        'editor_choice_id',
        'post_id',	
    ];

    public function post(): HasOne
    {
        return $this->hasOne(Posts::class, 'post_id', 'post_id');
    }
}
