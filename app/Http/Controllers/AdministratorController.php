<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function index()
    {
        $data['users'] = User::orderBy('id','desc')->get();
        return view('administrator.view', $data);
    }



    public function insert(Request $request)
    {
        $filename = date('dmyHis').'.jpg';
        $galeryData = [
            'galery_name'=>$request->galery_name,
            'galery_description'=>$request->galery_description,
            'galery_thumbnail'=>$filename
        ];

        // upload image
        $path = $request->file('galery_thumbnail')->storeAs('public/galery-images', $filename);

        if(User::create($galeryData))
        {
            return redirect()->back()->with('message-success', 'Berhasil menambah user');
        }
    }

    public function edit(Request $request)
    {
        $galery = User::find($request->id);
        if($request->file('galery_thumbnail')){
            $filename = date('dmYHis').'.jpg';
            $request->file('galery_thumbnail')->storeAs('public/galery-images', $filename);
            // remove old image
            Storage::delete('public/galery-images/'.$galery->galery_thumbnail);
            $galery->galery_thumbnail = $filename;
        }

        $galery->galery_name = $request->galery_name;
        $galery->galery_description = $request->galery_description;

        if($galery->save())
        {
            return redirect()->back()->with('message-success', 'Berhasil merubah user');
        }
    }

    public function delete($id)
    {
        if(User::where('id', $id)->delete())
        {
            return redirect()->back()->with('message-success', 'Berhasil menghapus user');
        }
    }
}
