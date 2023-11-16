<?php

// app/Http/Controllers/AdController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function index()
    {
        $data['ad_units'] = Ad::where('position', 'small')->get();
        $data['ad_script'] = Ad::where('position', 'scripts')->get();
        $data['big_hero'] = Ad::where('position','big_hero')->get();
        return view('ads.index', $data);
    }

    public function create_big_hero()
    {
        return view('ads.create_big_hero');
    }    
    
    public function create()
    {
        return view('ads.create');
    }

        
    public function create_script()
    {
        return view('ads.create_script');
    }

    public function store_script(Request $request)
    {
        $type = $request->type;
        $ads = [   
            'title'=>$request->title,
            'value'=>$request->value,
            'type'=>$type,
            'position'=>'scripts'
        ];
        Ad::create($ads);
        return redirect()->route('ads.index')->with('success', 'Ad created successfully.');
    }
    public function store_big_hero(Request $request)
    {
        $type = $request->type;
        if($type=='img'){
            $value = 'big_hero.jpeg';   
            $path = Storage::putFileAs('public/ads', $request->file('image'), $value);//$request->file('image')->storeAs('public/topic-images', 'test.jpg');
        }else{
            $value = $request->script;
        }

        $ads = [   
            'title'=>$request->title,
            'value'=>$value,
            'type'=>$type,
            'position'=>'big_hero'
        ];
        Ad::create($ads);
        return redirect()->route('ads.index')->with('success', 'Ad created successfully.');
    }

    public function clear_big_hero()
    {
        Ad::where('position', 'big_hero')->delete();
        return redirect()->route('ads.index');
    }

    
    public function store(Request $request)
    {
        $type = $request->type;
        if($type=='img'){
            $value = date('dmYhis').'.jpeg';   
            $path = Storage::putFileAs('public/ads', $request->file('image'), $value);//$request->file('image')->storeAs('public/topic-images', 'test.jpg');
        }else{
            $value = $request->script;
        }

        $ads = [   
            'title'=>$request->title,
            'value'=>$value,
            'type'=>$type,
            'position'=>'small'
        ];
        Ad::create($ads);
        return redirect()->route('ads.index')->with('success', 'Ad created successfully.');
    }

    public function edit($ad)
    {
        $data['ad'] = Ad::find($ad);
        return view('ads.edit', $data);
    }

    public function edit_script($ad)
    {
        $data['ad'] = Ad::find($ad);
        return view('ads.edit_script', $data);
    }

    public function update(Request $request, Ad $ad)
    {
        $type = $request->type;
        if($type=='img'){
            $value = date('dmYhis').'.jpeg';   
            $path = Storage::putFileAs('public/ads', $request->file('image'), $value);//$request->file('image')->storeAs('public/topic-images', 'test.jpg');
        }else{
            $value = $request->script;
        }

         
            $ad->title = $request->title;
            $ad->value = $value;
            $ad->position = 'small';
            $ad->type = $type;
            $ad->save();
        return redirect()->route('ads.index')->with('success', 'Ad created successfully.');
    }

    
    public function update_script(Request $request, Ad $ad)
    {
        $type = $request->type;
            $ad->title = $request->title;
            $ad->value = $request->value;
            $ad->position = 'scripts';
            $ad->type = $type;
            $ad->save();
        return redirect()->route('ads.index')->with('success', 'Ad created successfully.');
    }

    public function destroy(Ad $ad)
    {
        $ad->delete();

        return redirect()->route('ads.index')->with('success', 'Ad deleted successfully.');
    }
}

