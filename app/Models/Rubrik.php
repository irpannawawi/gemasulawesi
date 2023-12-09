<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sitemap\Tags\Url;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Spatie\Sitemap\Contracts\Sitemapable;

class Rubrik extends Model implements Sitemapable
{
    use HasFactory;
    protected $table = 'rubrik'; // Nama tabel jika berbeda dari nama model
    protected $primaryKey = 'rubrik_id'; // Nama kunci utama jika berbeda

    protected $fillable = [
        'rubrik_id',
        'rubrik_name',
        // 'rubrik_slug',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Posts::class, 'category', 'rubrik_id');
    }

    public function toSitemapTag(): Url | string | array
    {
        // Return with fine-grained control:
        
        return Url::create("category/".Str::slug($this->rubrik_name))
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.8);
    }
}
