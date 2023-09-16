<?php

namespace App\Http\Controllers;

use App\Models\Rubrik;
use Illuminate\Http\Request;

class RubrikController extends Controller
{
    //

    public function index(Request $request)
    {
        $data['rubriks'] = Rubrik::orderBy('rubrik_name', 'ASC')->get();
        return view('rubrik.view', $data);
    }

    public function insert(Request $request)
    {
        if(Rubrik::create(['rubrik_name'=>$request->rubrik_name])) return redirect()->back()->with('message-success', 'Berhasil menambah rubrik baru');
    } 
    
    public function edit(Request $request)
    {
        $id = $request->rubrik_id;
        $name = $request->rubrik_name;
        if(Rubrik::where('rubrik_id', $id)->update(['rubrik_name'=>$name])) return redirect()->back()->with('message-warning', 'Berhasil merubah rubrik');
    }


    public function delete($id)
    {
        if(Rubrik::where('rubrik_id', $id)->delete()) return redirect()->back()->with('message-danger', 'Berhasil menghapus rubrik');
    }
}
