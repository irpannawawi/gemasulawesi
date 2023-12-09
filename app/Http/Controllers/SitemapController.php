<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Rubrik;
use App\Models\Topic;
use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function generate()
    {
        $res = Sitemap::create()
        ->add(Url::create(config('app.url')))
        ->add(Rubrik::all())
        ->add(Topic::all())
        ->add(Posts::where('status', 'published')->orderBy('published_at', 'desc')->get())
        ->writeToFile(public_path('sitemap.xml'));
        dd($res);
    }
}
