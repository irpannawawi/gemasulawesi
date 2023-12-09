<?php

namespace App\Console\Commands;

use App\Models\Posts;
use App\Models\Rubrik;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
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
        Sitemap::create()
        ->add(Url::create(config('app.url')))
        ->add(Rubrik::all())
        ->add(Posts::all())
        ->writeToFile(public_path('sitemap.xml'));
    }
}
