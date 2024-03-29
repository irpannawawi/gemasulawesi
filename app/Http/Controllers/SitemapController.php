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
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function generate()
    {
        $sitemap = Sitemap::create();

        $sitemap->add(Url::create(config('app.url')));
        $sitemap->add(Url::create(config('app.url') . '/tentang-kami')->setchangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));
        $sitemap->add(Url::create(config('app.url') . '/kode-etik')->setchangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));
        $sitemap->add(Url::create(config('app.url') . '/redaksi')->setchangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));
        $sitemap->add(Url::create(config('app.url') . '/kode-prilaku-pers')->setchangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));
        $sitemap->add(Url::create(config('app.url') . '/perlindungan-data-pengguna')->setchangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));
        $sitemap->add(Url::create(config('app.url') . '/gallery')->setchangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));
        Storage::makeDirectory('public/sitemaps/site');
        $sitemap->writeToFile(storage_path("app/public/sitemaps/site/web.xml"));

        //posts sitemaps web, news, amps
        $this->create_posts();
        $this->create_amps();
        //  Add index
        $sitemapindex = SitemapIndex::create();
        $sitemapindex->add('storage/sitemaps/site/web.xml');

        $rubriks = Rubrik::all();
        foreach ($rubriks as $rubrik) {
            $folder_path = 'storage/sitemaps/' . Str::slug($rubrik->rubrik_name);
            $sitemapindex->add($folder_path . '/sitemap_web.xml');
            $sitemapindex->add($folder_path . '/sitemap_news.xml');
            // $sitemapindex->add($folder_path . '/sitemap_amp.xml');
        }
        
        // rubrik sitemaps
        $this->create_rubriks();
        $sitemapindex->add('storage/sitemaps/sitemap_rubrik.xml');
        
        // tags sitemaps
        $this->create_tags();
        $sitemapindex->add('storage/sitemaps/sitemap_tags.xml');


        $sitemapindex->writeToFile(public_path('sitemap.xml'));
    }



    public function create_posts()
    {
        $rubriks = Rubrik::all();
        foreach ($rubriks as $rubrik) {
            // buat folder jika belum ada
            $folder_name = Str::slug($rubrik->rubrik_name);
            $folder_path = "public/sitemaps/{$folder_name}";
            Storage::makeDirectory($folder_path);

            $data['posts'] = Posts::where('status', 'published')
                ->where('category', $rubrik->rubrik_id)
                ->orderBy('published_at', 'desc')
                ->limit(3000)
                ->get();

            // generate sitemap web
            Sitemap::create()
                ->add($data['posts'])
                ->writeToFile(storage_path("app/{$folder_path}/sitemap_web.xml")); // simpan ke storage
            
            
                // generate sitemap news
            $html = View::make('sitemap.google.news', $data)->render();
            Storage::put($folder_path . '/sitemap_news.xml', $html);
            
        }

    }
    
    public function create_amps()
    {
        $rubriks = Rubrik::all();
        foreach ($rubriks as $rubrik) {
            // buat folder jika belum ada
            $folder_name = Str::slug($rubrik->rubrik_name);
            $folder_path = "public/sitemaps/{$folder_name}";
            Storage::makeDirectory($folder_path);

            // generate sitemap
            Sitemap::create()
                ->add(Amp::where('status', 'published')
                    ->where('category', $rubrik->rubrik_id)
                    ->orderBy('published_at', 'desc')
                    ->limit(3000)
                    ->get())
                ->writeToFile(storage_path("app/{$folder_path}/sitemap_amp.xml")); // simpan ke storage

        }
    }
    public function create_rubriks()
    {
        $folder_path = "public/sitemaps/";
        // generate sitemap
        Sitemap::create()
            ->add(Rubrik::all())
            ->writeToFile(storage_path("app/public/sitemaps/sitemap_rubrik.xml"));
        return null;
    }


    public function create_tags()
    {
        $folder_path = "public/sitemaps/";
        // generate sitemap
        Sitemap::create()
            ->add(Tags::limit(5000)->get())
            ->writeToFile(storage_path("app/{$folder_path}/sitemap_tags.xml"));
        return null;
    }
}
