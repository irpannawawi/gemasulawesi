<?php

namespace App\Http\Controllers;

use App\Jobs\MigrateJob;
use App\Models\Asset;
use App\Models\Image;
use App\Models\Posts;
use App\Models\Rubrik;
use App\Models\Tags;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function insert(Request $request)
    {
        $articleData =  json_decode(json_encode($request->all()), FALSE);

        $job = MigrateJob::dispatch($articleData);
        

        return response()->json($job);
    }
}
