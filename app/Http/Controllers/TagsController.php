<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    //

    public function index(Request $request){
        $q = $request->q;
        $tagsQuery = Tags::orderBy('tag_id', 'DESC');
        if($q!=''){
            $tagsQuery = $tagsQuery->where('tag_name', 'like', '%'.$q.'%');
        }
        
        $data['tags'] = $tagsQuery->paginate(25);
        return view('web-management.tags.index', $data);
    }

    public function modal_tags(Request $request)
    {
        $q = $request->q;
        $tagsQuery = Tags::orderBy('tag_id', 'DESC');
        if($q!=''){
            $tagsQuery = $tagsQuery->where('tag_name', 'like', '%'.$q.'%');
        }
        
        $data['tags'] = $tagsQuery->paginate(25);
        return view('editorial.components.modal_tags', $data);
    }

    public function insert(Request $request)
    {
        $tag_name = ucfirst($request->tag_name);
        if(Tags::where('tag_name', $tag_name)->first()){
            return redirect()->back()->with('error', 'Tag sudah ada');
        }else{
            if (Tags::create(['tag_name' => $tag_name])) {
                return redirect()->back()->with('success', 'Berhasil menambah tag');
            }
        }
    }

    public function edit(Request $request)
    {
        if (Tags::where('tag_id', $request->tag_id)->update(['tag_name' => $request->tag_name])) {
            return redirect()->back()->with('success', 'Berhasil menambah tag');
        }
    }

    public function delete($id)
    {
        if (Tags::where('tag_id', $id)->delete()) {
            return redirect()->back()->with('success', 'Berhasil menghapus tag');
        }
    }

    public function select2(Request $request)
    {
        $query = $request->q;
        $tags = Tags::where('tag_name', 'LIKE', '%' . $query . '%')->limit(7)
        ->orderByRaw("CASE WHEN tag_name = '$query' THEN 1 
                       WHEN tag_name LIKE '$query%' THEN 2
                       WHEN tag_name LIKE '%$query%' THEN 3
                       ELSE 4 END")->orderBy('tag_name', 'asc')->get();
        return response()->json(['tags' => $tags]);
    }

    public function api_list(Request $request)
    {
        $id = $request->tag_name;
        $res = Tags::where('tag_name', $id)->get();
        if ($res->count() > 0) {
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

    public function api_create(Request $request)
    {
        $tag_name = $request->tag_name;
        $res = Tags::create(['tag_name' => $tag_name]);
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
}
