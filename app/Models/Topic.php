<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Topic extends Model implements Sitemapable
{
    use HasFactory;
    protected $table = 'topics';

    protected $primaryKey = 'topic_id';
    public $fillable = [
        'topic_id',
        'topic_name',
        'slug',
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

    
    public function toSitemapTag(): Url | string | array
    {
        // Return with fine-grained control:
        
        return Url::create("/topik-khusus/detail/".$this->topic_id."/".Str::slug($this->topic_name))
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.8);
    }
}
