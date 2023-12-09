<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;


class SitemapController extends Controller
{
    public function generate()
    {
        
        Sitemap::create()
        ->add(Posts::all())
        ->writeToFile(public_path('sitemap.xml'));
    }
}
