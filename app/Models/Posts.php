<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Posts extends Model implements Sitemapable, Feedable
{
    use HasFactory;
    protected $table = 'posts';

    protected $primaryKey = 'post_id';
    public $fillable = [
        'post_id',
        'title',
        'slug',
        'category',
        'description',
        'article',
        'allow_comment',
        'view_in_welcome_page',
        'author_id',
        'editor_id',
        'status',
        'tags',
        'sources',
        'related_articles',
        'topics',
        'schedule_time',
        'published_at',
        'is_deleted',
        'post_image',
        'origin_id',
    ];

    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($query) use ($keyword) {
            $query->where('title', 'like', "%$keyword%")
                ->orWhere('article', 'like', "%$keyword%");
        });
    }

    public function editor(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'editor_id');
    }
    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function rubrik(): HasOne
    {
        return $this->hasOne(Rubrik::class, 'rubrik_id', 'category');
    }

    public function image(): HasOne
    {
        return $this->hasOne(Image::class, 'image_id', 'post_image');
    }

    public function toSitemapTag(): Url | string | array
    {
        // Return with fine-grained control:
        return Url::create("id/" . Str::slug($this->rubrik->rubrik_name) . "/" . $this->post_id . "/" . $this->slug)
            ->setLastModificationDate(Carbon::create($this->published_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.5);
    }

    public function toFeedItem(): FeedItem
    {
        $postImage = get_post_image($this->post_id);
        $postThumbnail = get_post_thumbnail($this->post_id);
        $imageLength = Storage::size(str_replace('storage/', 'public/', $postImage));
        $imageType = Storage::mimeType(str_replace('storage/', 'public/', $postImage));

        return FeedItem::create(['content'=>$this->article])
            ->id($this->post_id)
            ->title($this->title)
            ->summary('<img src="'.url('/').$postThumbnail.'" align="left" hspace="5" width="100" />'.$this->description)
            ->updated($this->updated_at)
            ->link(route('singlePost', ['rubrik' => Str::slug($this->rubrik->rubrik_name), 'post_id' => $this->post_id, 'slug' => $this->slug]))
            ->authorName($this->author->display_name)
            ->enclosure(url('/').$postImage)
            ->enclosureLength($imageLength)
            ->enclosureType($imageType)
            ->authorEmail($this->author->email);
    }

    public static function getAllFeedItems()
    {
        return Posts::orderBy('published_at', 'desc')
        ->limit(1)
        ->where('published_at', '>=', Carbon::now()->subHours(12)->toDateTimeString())
        ->get();
    }
}
