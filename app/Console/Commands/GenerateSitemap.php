<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Sitemap';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SitemapGenerator::create(config('app.url'))
        ->hasCrawled(function (Url $url) {
            $exclude = [
                'post',
                'tags',
                'forgot-password',
                'dashboard',
                'login',
                'register',
                'indeks-berita',
                'storage'
    
            ];
            if (in_array($url->segment(1), $exclude)) {
                return;
            }

            if(count(explode('?', $url->url))>1){
                return;
            }

            if(count(explode(' ', $url->url))>1){
                return;
            }
            if(count(explode('%20', $url->url))>1){
                return;
            }
     
            return $url;
        })
        // ->setMaximumCrawlCount(100)
            ->writeToFile(public_path('sitemap.xml'));
    }
}
