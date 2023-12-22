<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Amp;
use App\Models\Rubrik;
use App\Models\Tags;
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
        $sitemap = Sitemap::create();
        $sitemap->add(config('app.url'));
        $sitemap->add(config('app.url').'/tentang-kami');
        $sitemap->add(config('app.url').'/kode-etik');
        $sitemap->add(config('app.url').'/redaksi');
        $sitemap->add(config('app.url').'/kode-prilaku-pers');
        $sitemap->add(config('app.url').'/perlindungan-data-pengguna');
        $sitemap->add(config('app.url').'/gallery');

        //posts sitemaps
        $this->create_amps();
        $this->create_amps();
        
        $rubriks = Rubrik::all();
        foreach ($rubriks as $rubrik) {
            $sitemap->add('storage/sitemaps/' . Str::slug($rubrik->rubrik_name) . '/sitemap_web.xml');
            $sitemap->add('storage/sitemaps/amp/' . Str::slug($rubrik->rubrik_name) . '/sitemap_web.xml');
        }

        // rubrik sitemaps
        
        // tags sitemaps
        $this->create_tags();
        
        $rubriks = Rubrik::all();
        foreach ($rubriks as $rubrik) {
            $sitemap->add('storage/sitemaps/' . Str::slug($rubrik->rubrik_name) . '/sitemap_web.xml');
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }

    public function create_site()
    {

    }

    public function create_posts()
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
        $rubriks = Rubrik::all();
        foreach ($rubriks as $rubrik) {
            // buat folder jika belum ada
            $folder_name = Str::slug($rubrik->rubrik_name);
            $folder_path = "public/sitemaps/amp/{$folder_name}";
            Storage::makeDirectory($folder_path);

            // generate sitemap
            Sitemap::create()
                ->add(Amp::where('status', 'published')
                    ->where('category', $rubrik->rubrik_id)
                    ->orderBy('published_at', 'desc')
                    ->limit(200)
                    ->get())
                ->writeToFile(storage_path("app/{$folder_path}/sitemap_web.xml")); // simpan ke storage

        }

        $rubriks = Rubrik::all();
        foreach ($rubriks as $rubrik) {
            // buat folder jika belum ada
            $folder_name = Str::slug($rubrik->rubrik_name);
            $folder_path = "public/sitemaps/amp/{$folder_name}";
            Storage::makeDirectory($folder_path);

            // generate sitemap
            Sitemap::create()
                ->add(Amp::where('status', 'published')
                    ->where('category', $rubrik->rubrik_id)
                    ->orderBy('published_at', 'desc')
                    ->limit(200)
                    ->get())
                ->writeToFile(storage_path("app/{$folder_path}/sitemap_web.xml")); // simpan ke storage

        }
    }

    public function create_tags()
    {
        $res = Sitemap::create()
            ->add(Tags::all())
            ->writeToFile(public_path('sitemap/tags.xml'));
    }
}
