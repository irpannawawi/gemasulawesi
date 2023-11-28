<?php

namespace App\Http\Controllers;

use App\Models\Rubrik;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RubrikController extends Controller
{
    public function index(Request $request)
    {
        $data['rubriks'] = Rubrik::orderBy('rubrik_name', 'ASC')->get();
        return view('rubrik.view', $data);
    }

    public function insert(Request $request)
    {
        if (Rubrik::create([
            'rubrik_name' => $request->rubrik_name
        ])) return redirect()->back()->with('success', 'Berhasil menambah rubrik baru');
    }

    public function edit(Request $request)
    {
        $id = $request->rubrik_id;
        $name = $request->rubrik_name;
        if (Rubrik::where('rubrik_id', $id)->update(['rubrik_name' => $name])) return redirect()->back()->with('message-warning', 'Berhasil merubah rubrik');
    }

    public function delete($id)
    {
        if (Rubrik::where('rubrik_id', $id)->delete()) return redirect()->back()->with('message-danger', 'Berhasil menghapus rubrik');
    }

    public function api_list(Request $request)
    {
        $id = $request->rubrik_name;
        $res = Rubrik::where('rubrik_name', $id)->get();
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
        $rubrik_name = $request->rubrik_name;
        $res = Rubrik::create(['rubrik_name' => $rubrik_name]);
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
