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
        if(Tags::create(['tag_name'=>$request->tag_name, 'tag_link'=>$request->tag_link]))
        {
            return redirect()->back()->with('message-success', 'Berhasil menambah tag');
        }
    }
}
