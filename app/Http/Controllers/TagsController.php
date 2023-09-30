<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    //
    
    public function modal_tags()
    {
        $data['tags'] = Tags::orderBy('tag_id', 'DESC')->get();
        return view('editorial.components.modal_tags', $data);
    }

    public function insert(Request $request)
    {
        if(Tags::create(['tag_name'=>$request->tag_name]))
        {
            return redirect()->back()->with('message-success', 'Berhasil menambah tag');
        }
    }

    public function edit(Request $request)
    {
        if(Tags::where('tag_id', $request->tag_id)->update(['tag_name'=>$request->tag_name]))
        {
            return redirect()->back()->with('message-success', 'Berhasil menambah tag');
        }
    }

    public function delete($id)
    {
        if(Tags::where('tag_id', $id)->delete())
        {
            return redirect()->back()->with('message-success', 'Berhasil menghapus tag');
        }
    }
}