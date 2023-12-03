<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    //

    public function modal_source(Request $request)
    {
        $q = $request->q;
        $sourcesQuery = Source::orderBy('source_id', 'DESC');
        if($q!=''){
            $sourcesQuery = $sourcesQuery->where('source_name', 'like', '%'.$q.'%');
        }
        $data['sources'] = $sourcesQuery->get();
        return view('editorial.components.modal_source', $data);
    }

    public function insert(Request $request)
    {
        $sourceData = [
            'source_name' => $request->source_name,
            'source_alias' => $request->source_alias,
            'source_website' => $request->source_website,
            'source_logo_url' => $request->source_logo_url,
        ];
        if (Source::create($sourceData)) {
            return redirect()->back()->with('success', 'Berhasil menambah source');
        }
    }

    public function edit(Request $request)
    {
        $sourceData = [
            'source_name' => $request->source_name,
            'source_alias' => $request->source_alias,
            'source_website' => $request->source_website,
            'source_logo_url' => $request->source_logo,
        ];
        if (Source::where('source_id', $request->source_id)->update($sourceData)) {
            return redirect()->back()->with('success', 'Berhasil menambah source');
        }
    }

    public function delete($id)
    {
        if (Source::where('source_id', $id)->delete()) {
            return redirect()->back()->with('success', 'Berhasil menghapus source');
        }
    }

    public function select2(Request $request)
    {
        $query = $request->q;
        $sources = Source::where('source_name', 'LIKE', '%' . $query . '%')
            ->orWhere('source_alias', 'LIKE', '%' . $query . '%')
            ->orWhere('source_website', 'LIKE', '%' . $query . '%')->get();
        return response()->json(['sources' => $sources]);
    }
}
