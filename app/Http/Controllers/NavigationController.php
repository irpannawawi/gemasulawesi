<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use App\Models\Navlinks;
use App\Models\Rubrik;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'navs' => Navigation::orderBy('order_priority')->get(),
            'rubriks' => Rubrik::whereNotIn('rubrik_id', function($query){
                $query->select('rubrik_id')->from('navigation_links');
            })->get(),
            'rubriksAll' => Rubrik::all(),
        ];
        return view('navigation.index', $data);
    }

    public function list_rubrik(Request $request, $id)
    {
        $nav = Navigation::find($id);

        return response()->json($nav->navlinks);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'nav_name' => 'required',
            'nav_type' => 'required'
        ]);
        $order = Navigation::get()->count()+1;
        $data = [
            'nav_name' => $request->nav_name,
            'nav_type' => $request->nav_type,
            'order_priority' => $order,
        ];
        $nav = Navigation::create($data);
        if ($request->nav_type == 'normal') {
            $nav_id = $nav->nav_id;
            $rubrik_id = $request->nav_rubrik;
            Navlinks::create(['nav_id' => $nav_id, 'rubrik_id' => $rubrik_id]);
        }

        return redirect()->back()->with('success', 'Berhasil Menambah Navigasi Baru');
    }

    public function insert_rubrik(Request $request)
    {
        Navlinks::where('nav_id', $request->nav_id)->delete();
        if($request->rubriks!=null)
        {
            foreach($request->rubriks as $key => $value){
                $nav_id = $request->nav_id;
                Navlinks::create(['nav_id' => $nav_id, 'rubrik_id' => $value]);
            }
        }


        return redirect()->back()->with('last_load', $request->nav_id);
    }

    public function delete($id)
    {
        Navlinks::where('nav_id', $id)->delete();
        $nav = Navigation::find($id);
        $list_higger_order = Navigation::orderBy('order_priority')->where('order_priority', '>', $nav->order_priority)->get();
        $order = $nav->order_priority;

        foreach($list_higger_order as $nv){
            $nv->order_priority = $order;
            $order+=1;
            $nv->save();
        }
        $nav->delete();
        return redirect()->route('nav')->with('success', 'Berhasil Menghapus Navigasi');

    }

    
    public function update(Request $request)
    {
        $id = $request->nav_id;
        $nav = Navigation::find($id);
        $nav->nav_name = $request->nav_name;
        $nav->save();
        return redirect()->back()->with('last_load', $request->nav_id)->with('success', 'Berhasil Merubah Navigasi');

    }

    public function change_order_up($id)
    {
        $nav = Navigation::find($id);
        $prev_nav = Navigation::where('order_priority', $nav->order_priority-1)->get();
        if($prev_nav->count()>0){
            $nav->order_priority -=1;
            $prev_nav[0]->order_priority +=1;
            $nav->save();
            $prev_nav[0]->save();
        }
        return redirect()->back()->with('last_load', $id)->with('success', 'Berhasil Merubah Navigasi');
        
    }

    
    public function change_order_down($id)
    {
        $nav = Navigation::find($id);
        $next_nav = Navigation::where('order_priority', $nav->order_priority+1)->get();
        if($next_nav->count()>0){
            $nav->order_priority +=1;
            $next_nav[0]->order_priority -=1;
            $nav->save();
            $next_nav[0]->save();
        }
        return redirect()->back()->with('last_load', $id)->with('success', 'Berhasil Merubah Navigasi');
        
    }
}
