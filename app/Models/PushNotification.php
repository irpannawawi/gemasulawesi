<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PushNotification extends Model
{
    use HasFactory;
    protected $table = 'push_notification';

    protected $primaryKey = 'notif_id';
    public $fillable = [
        'notif_id',
        'post_id',
        'title',
        'body',
        'url',
        'image',
        'status',
        'scheduled_at',	
        'created_at',
        'updated_at',
        'one_signal_id',
    ];

    public function post(): HasOne
    {
        return $this->hasOne(Posts::class, 'post_id', 'post_id');
    }
    
    
    
    
    
    
}
