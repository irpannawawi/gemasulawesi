<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Rubrik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditorialContorller extends Controller
{
    public function create()
    {
        $data = [
            'rubriks'=>Rubrik::get(),
        ];
        return view('editorial.create', $data);
    }

    public function insert(Request $request)
    {
        $postData = [
        'title'=>$request->title,
        'slug'=>str_replace(' ', '-', $request->title),
        'category'=>$request->rubrik,
        'description'=>$request->description,
        'article'=>$request->content,
        'allow_comment'=>$request->allow_comment,
        'view_in_welcome_page'=>$request->view_in_welcome_page,
        'author_id'=>Auth::user()->id,
        'editor_id'=>Auth::user()->id,
        'status'=>'published'
        ];
        if(Posts::create($postData))
        {
            return redirect()->back();
        }
        // dd($request->all());
    }

}
