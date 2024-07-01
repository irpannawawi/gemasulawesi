<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Galeri;
use App\Models\Image;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    //
    public function galeri()
    {
        $data['galeris'] = Galeri::orderBy('galery_id', 'desc')->get();
        return view('galeri.index', $data);
    }

    public function insert(Request $request)
    {
        $filename = date('dmyHis') . '.jpg';
        $galeryData = [
            'galery_name' => $request->galery_name,
            'galery_description' => $request->galery_description,
            'galery_thumbnail' => $filename,
            'created_at'=>Carbon::createFromDate($request->created_at)
        ];

        // upload image
        $path = $request->file('galery_thumbnail')->storeAs('public/galery-images', $filename);

        if (Galeri::create($galeryData)) {
            return redirect()->back()->with('success', 'Berhasil menambah galeri');
        }
    }

    public function edit(Request $request)
    {
        $galery = Galeri::find($request->galery_id);
        if ($request->file('galery_thumbnail')) {
            $filename = date('dmYHis') . '.jpg';
            $request->file('galery_thumbnail')->storeAs('public/galery-images', $filename);
            // remove old image
            Storage::delete('public/galery-images/' . $galery->galery_thumbnail);
            $galery->galery_thumbnail = $filename;
        }

        $galery->galery_name = $request->galery_name;
        $galery->galery_description = $request->galery_description;
        $galery->created_at = Carbon::createFromDate($request->created_at);
        if ($galery->save()) {
            return redirect()->back()->with('success', 'Berhasil merubah galeri');
        }
    }

    public function delete($id)
    {
        if (Galeri::where('galery_id', $id)->delete()) {
            return redirect()->back()->with('success', 'Berhasil menghapus galeri');
        }
    }


    public function collection($id)
    {
        $data['collections'] = Collection::where('galery_id', $id)->orderBy('collection_id', 'desc')->get();
        $data['galery'] = Galeri::find($id);
        $data['photos'] = Image::orderBy('image_id', 'DESC')->paginate(20);
        $data['videos'] = Video::orderBy('video_id', 'DESC')->paginate(20);

        // dd($data['collections'][1]->photo->image_id);
        return view('galeri.collection', $data);
    }

    public function galeri_modal(Request $request, $id)
    {
        $data['collections'] = Collection::where('galery_id', $id)->orderBy('collection_id', 'desc')->pluck('file_id')->toArray();
        $data['galery'] = Galeri::find($id);

        $photo = 
        Image::whereNotIn('image_id', $data['collections'])
        ->orderBy('image_id', 'DESC');
        if(isset($request->q)){
            $photo = $photo->where('caption', 'LIKE', '%' . $request->q . '%');
            $photo = $photo->orWhere('author', 'LIKE', '%' . $request->q . '%');
            $photo = $photo->orWhere('credit', 'LIKE', '%' . $request->q . '%');
            $photo = $photo->orWhere('source', 'LIKE', '%' . $request->q . '%');
            $data['q'] = $request->q;
        }
        $data['photos'] = $photo->paginate(20);
        
        $data['videos'] = Video::orderBy('video_id', 'DESC')->paginate(20);

        // dd($data['collections'][1]->photo->image_id);
        return view('galeri.modal', $data);
    }

    public function collection_insert(Request $request)
    {
        $type = $request->type;
        $files = $request->get('files');
        foreach ($files as $file) {
            // if image != exits on collection
            if (!Collection::where('galery_id', $request->galery_id)->where('file_id', $file)->exists()){
                Collection::create(['type' => $type, 'file_id' => $file, 'galery_id' => $request->galery_id]);
            }
        }

        return redirect()->back()->with('success', 'success');
    }

    public function collection_delete($id)
    {
        Collection::where('collection_id', $id)->delete();

        return redirect()->back();
    }
}
