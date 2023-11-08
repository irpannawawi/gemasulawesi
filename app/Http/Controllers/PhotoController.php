<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Image::orderBy('image_id', 'DESC')->get();
        return view('assets.photo.index', compact('photos'));
    }

    public function browse() {
        $data['photos'] = Image::get();
        return view('browse', $data);
    }

    public function upload(Request $request)
    {
        $path = $request->file('photo')->store('public/photos');
        // insert to file table
        $asset = Asset::create(['file_name'=>explode('/', $path)[2]]);
        

        // insert image details
        $imageDetails = [
            'asset_id'=>$asset->asset_id,
            'uploader_id'=>Auth::user()->id,
            'author'=>$request->author,
            'caption'=>$request->caption,
            'credit'=>$request->credit,
            'source'=>$request->source,
            
        ];
        Image::create($imageDetails);
        return redirect()->route('assets.photo.index');  
    }

    public function upload_api(Request $request)
    {
        
        $file_name = $request->file_name;
        $image_url = $request->image_url;

        Storage::put('public/photos/'.$file_name, file_get_contents($image_url));
        // insert to file table
        $asset = Asset::create(['file_name'=>$file_name]);
        

        // insert image details
        $imageDetails = [
            'asset_id'=>$asset->asset_id,
            'uploader_id'=>1,
            'author'=>$request->author,
            'caption'=>$request->caption,
            'credit'=>$request->credit,
            'source'=>$request->source,
            
        ];
        $res = Image::create($imageDetails);
        
        if ($res) {
            return response()->json([
                'status' => True,
                'data' => $res
            ]);
        } else {
            return response()->json([
                'status' => False
            ]);
        }
    }

    public function upload_image_only(Request $request)
    {
        
        $file_name = $request->file_name;
        $image_url = $request->image_url;

        $res = Storage::put('public/photos/'.$file_name, file_get_contents($image_url));
        // insert to file table        
        if ($res) {
            return response()->json([
                'status' => True,
                'data' => $res
            ]);
        } else {
            return response()->json([
                'status' => False
            ]);
        }
    }
    public function delete($id)
    {
        $image = Image::find($id);

        // insert to file table
        $image->delete();
        $asset_id = $image->asset_id;
        Asset::where(['asset_id'=>$asset_id])->delete();

        return redirect()->route('assets.photo.index');  
    }
}
