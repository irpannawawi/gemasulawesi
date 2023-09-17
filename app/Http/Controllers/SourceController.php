<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    //

    public function modal_source()
    {
        $data['sources'] = Source::orderBy('source_id', 'DESC')->get();
        return view('editorial.components.modal_source', $data);
    }

    public function insert(Request $request)
    {
        $sourceData = [
            'source_name'=>$request->source_name,
            'source_alias'=>$request->source_alias,
            'source_website'=>$request->source_website,
            'source_logo_url'=>$request->source_logo_url,
        ];
        if(Source::create($sourceData))
        {
            return redirect()->back()->with('message-success', 'Berhasil menambah source');
        }
    }

    public function edit(Request $request)
    {
        $sourceData = [
            'source_name'=>$request->source_name,
            'source_alias'=>$request->source_alias,
            'source_website'=>$request->source_website,
            'source_logo_url'=>$request->source_logo,
        ];
        if(Source::where('source_id', $request->source_id)->update($sourceData))
        {
            return redirect()->back()->with('message-success', 'Berhasil menambah source');
        }
    }

    public function delete($id)
    {
        if(Source::where('source_id', $id)->delete())
        {
            return redirect()->back()->with('message-success', 'Berhasil menghapus source');
        }
    }
}
