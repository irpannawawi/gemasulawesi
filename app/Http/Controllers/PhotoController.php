<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Image::orderBy('image_id', 'DESC')->paginate(20);
        return view('assets.photo.index', compact('photos'));
    }

    public function browse()
    {
        $data['photos'] = Image::orderBy('image_id', 'DESC')->paginate(10);
        return view('browse', $data);
    }

    public function browse_edit_image($imageId)
    {
        $data['image'] = Image::find($imageId);
        return view('editorial.components.modal_edit_image', $data);
    }

    public function update_image_tinymce(Request $request)
    {
        $old_image = Image::find($request->image_id);
        $image = new Image;
        $image->asset_id = $old_image->asset->asset_id;
        $image->uploader_id = Auth::user()->id;
        $image->author = $request->author;
        $image->caption = $request->caption;
        $image->credit = $request->credit;
        $image->source = $request->source;
        $image->save();
        $image_url = Storage::url('photos/' . $image->asset->file_name);

        return redirect()->route('browseEditImage', ['id' => $image->image_id])->with(['msg' => 'success', 'image_url' => $image_url, 'image_id' => $image->image_id]);
    }

    public function upload(Request $request)
    {
        $path = $request->file('photo')->store('public/photos');
        // insert to file table
        $asset = Asset::create(['file_name' => explode('/', $path)[2]]);


        // insert image details
        $imageDetails = [
            'asset_id' => $asset->asset_id,
            'uploader_id' => Auth::user()->id,
            'author' => $request->author,
            'caption' => $request->caption,
            'credit' => $request->credit,
            'source' => $request->source,

        ];
        Image::create($imageDetails);
        return redirect()->route('assets.photo.index');
    }

    public function upload_api(Request $request)
    {

        $file_name = $request->file_name;
        $image_url = $request->image_url;

        Storage::put('public/photos/' . $file_name, file_get_contents($image_url));
        // insert to file table
        $asset = Asset::create(['file_name' => $file_name]);


        // insert image details
        $imageDetails = [
            'asset_id' => $asset->asset_id,
            'uploader_id' => 1,
            'author' => $request->author,
            'caption' => $request->caption,
            'credit' => $request->credit,
            'source' => $request->source,

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

        $res = Storage::put('public/photos/' . $file_name, file_get_contents($image_url));
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
        Asset::where(['asset_id' => $asset_id])->delete();

        return redirect()->back()->with('success', 'Photo deleted successfully.');
    }
}
