<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Image as ImageMaker;
class PhotoController extends Controller
{
    public function index(Request $request)
    {
        $photos = Image::orderBy('image_id', 'DESC')->where('image_sc_type', 'original');
        $uploader = $request->uploader;
        $q = $request->q;
        if($uploader!=''){
            $photos->where('uploader_id', $uploader);
        }

        if($q!=''){
            $photos->where('caption', 'like', '%'.$q.'%');
            $photos->orWhere('credit', 'like', '%'.$q.'%');
            $photos->orWhere('source', 'like', '%'.$q.'%');
            $photos->orWhere('author', 'like', '%'.$q.'%');
        }

        $data = [
            'q'=>$q,
            'uploader'=>$uploader,
            'photos'=>$photos->paginate(20),
        ];
        return view('assets.photo.index',$data);
    }

    public function edit($id)
    {
        $image = Image::find($id);
        return view('assets.photo.edit', compact('image'));
    }

    public function browse(Request $request)
    {
        $q = $request->q;
        $data['photos'] = Image::orderBy('image_id', 'DESC')
            ->where('caption', 'LIKE', '%' . $q . '%')
            ->where('image_sc_type', 'original')
            ->paginate(12);
        return view('browse', $data);
    }

    public function browse_edit_image($imageId, $source)
    {
        $data['image'] = Image::find($imageId);
        $data['source'] = $source;
        return view('editorial.components.modal_edit_image', $data);
    }

    public function update(Request $request)
    {
        // jika source == ORIGINAL
        $image = Image::find($request->image_id);
        // update data lama
        $image->author = $request->author;
        $image->caption = $request->caption;
        $image->credit = $request->credit;
        $image->source = $request->source;
        $image->save();
        $image_url = Storage::url('photos/' . $image->asset->file_name);
        return redirect()->route('assets.photo.index')->with(['success' => 'success']);
    }
    public function update_image_tinymce(Request $request)
    {
        // jika source == ORIGINAL
        $old_image = Image::find($request->image_id);
        if ($request->source_image == 'original') {
            // update data lama
            $old_image->author = $request->author;
            $old_image->caption = $request->caption;
            $old_image->credit = $request->credit;
            $old_image->source = $request->source;
            $old_image->save();
            $image = $old_image;
        } else {
            // buat baru
            $image = new Image;
            $image->asset_id = $old_image->asset->asset_id;
            $image->uploader_id = Auth::user()->id;
            $image->author = $request->author;
            $image->caption = $request->caption;
            $image->credit = $request->credit;
            $image->source = $request->source;
            $image->image_sc_type = $request->source_image;
            $image->save();
        }
        $image_url = Storage::url('photos/' . $image->asset->file_name);
        return redirect()->route('browseEditImage', ['id' => $image->image_id, 'source' => $request->source_image])->with(['msg' => 'success', 'image_url' => $image_url, 'image_id' => $image->image_id]);
    }

    public function upload(Request $request)
    {
        // $path = $request->file('photo')->store('public/photos');
        // // insert to file table
        $image = $this->save_image($request->file('photo'));
        $this->save_image_jpeg($request->file('photo'), $image->basename);

        $asset = Asset::create(['file_name' => $image->basename]);
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

    public function browse_upload(Request $request)
    {
        $image = $this->save_image($request->file('photo'));
        $this->save_image_jpeg($request->file('photo'), $image->basename);
        // insert to file table
        $asset = Asset::create(['file_name' => $image->basename]);


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
        return redirect()->route('browseImage');
    }

    public function upload_api(Request $request) //unused
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

    public function upload_image_only(Request $request) // unused
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
        $asset_id = $image->asset_id;
        $image->delete();
        Asset::where(['asset_id' => $asset_id])->delete();

        return redirect()->back()->with('success', 'Photo deleted successfully.');
    }

    public function browse_delete($id)
    {
        $image = Image::find($id);

        // insert to file table
        $image->delete();
        $asset_id = $image->asset_id;
        // Asset::where(['asset_id' => $asset_id])->delete();
        return redirect()->back()->with('success', 'Photo deleted successfully.');
    }


    public function save_image($image)
    {
        $file_name = date('dmYhis').'.webp';
        $file_path = public_path('storage/photos/'.$file_name);
        // Kompresi gambar tanpa resize dan konversi ke format WebP
        $compressedImage = ImageMaker::make($image->getRealPath())
        ->encode('webp', 70) // Konversi ke WebP dengan tingkat kualitas 60
        ->resize(750, 500) 
        ->save($file_path);
       return $compressedImage; 
    }

    public function save_image_jpeg($image, $name)
    {
        $name = str_replace('webp', 'jpeg', $name);
        $file_path = public_path('storage/photos/jpeg/'.$name);
        // Kompresi gambar tanpa resize dan konversi ke format WebP
        $compressedImage = ImageMaker::make($image->getRealPath())
        ->encode('jpeg', 70) // Konversi ke WebP dengan tingkat kualitas 60
        ->resize(750, 500) 
        ->save($file_path);
       return $compressedImage; 
    }
}
