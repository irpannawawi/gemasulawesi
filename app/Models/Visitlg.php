<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitlg extends Model
{
    use HasFactory;
    protected $table = 'visitlogs';

    protected $primaryKey = 'id';
    public $fillable = [
        'id',
        'ip',
        'page',	
        'browser',	
        'os',	
        'user_id',	
        'user_name',	
        'country_code',	
        'country_name',	
        'region_name',	
        'city',	
        'zip_code',	
        'timezone',	
        'latitude',	
        'longitude',	
        'is_banned',	
        'created_at',	
        'updated_at',	
    ];
}
