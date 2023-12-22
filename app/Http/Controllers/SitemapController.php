<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Amp;
use App\Models\Rubrik;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function generate()
    {
        $this->create_web_post();
        $this->create_news_post();

        $sitemap = Sitemap::create();
        $rubriks = Rubrik::all();
        foreach ($rubriks as $rubrik) {
            $sitemap->add('storage/sitemaps/' . Str::slug($rubrik->rubrik_name) . '/sitemap_web.xml');
        }
        $sitemap->writeToFile(public_path('sitemap.xml'));
    }

    public function create_site()
    {
    }

    public function create_web_post()
    {
        $rubriks = Rubrik::all();
        foreach ($rubriks as $rubrik) {
            // buat folder jika belum ada
            $folder_name = Str::slug($rubrik->rubrik_name);
            $folder_path = "public/sitemaps/{$folder_name}";
            Storage::makeDirectory($folder_path);

            // generate sitemap
            Sitemap::create()
                ->add(Posts::where('status', 'published')
                    ->where('category', $rubrik->rubrik_id)
                    ->orderBy('published_at', 'desc')
                    ->limit(200)
                    ->get())
                ->writeToFile(storage_path("app/{$folder_path}/sitemap_web.xml")); // simpan ke storage

        }
    }

    public function create_news_post()
    {
        $rubriks = Rubrik::all();
        foreach ($rubriks as $rubrik) {
            $folder_name = Str::slug($rubrik->rubrik_name);
            // buat folder jika belum ada
            $folder_path = "public/sitemaps/{$folder_name}";
            Storage::makeDirectory($folder_path);
            $data['posts'] = Posts::where('status', 'published')
            ->where('category', $rubrik->rubrik_id)
            ->orderBy('published_at', 'desc')
            ->limit(200)
            ->get();
            // Render the view
            $html = View::make('sitemap.google.news', $data)->render();
    
            // Specify the file path
            
            // Write the rendered HTML to the file
            Storage::put($folder_path.'/sitemap_news.xml', $html);

        }
    }

    public function create_rubriks()
    {
        $res = Sitemap::create()
            ->add(Rubrik::all())
            ->writeToFile(public_path('sitemap/rubriks.xml'));
        return null;
    }

    public function create_amps()
    {
    }

    public function create_tags()
    {
    }
}
