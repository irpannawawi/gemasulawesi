<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\Contracts\Sitemapable;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class Tags extends Model implements Sitemapable
{
    use HasFactory;
    protected $table = 'tags'; // Nama tabel jika berbeda dari nama model
    protected $primaryKey = 'tag_id'; // Nama kunci utama jika berbeda

    protected $fillable = [
        'tag_id',
        'tag_name',
    ];

    public function toSitemapTag(): Url | string | array
    {
        // Return with fine-grained control:
        
        return Url::create("tags/".Str::slug($this->tag_name))
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.8);
    }
}
