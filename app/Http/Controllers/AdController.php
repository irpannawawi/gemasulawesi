<?php

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
        $data['big_hero'] = Ad::where('position', 'big_hero')->get();
        return view('ads.index', $data);
    }

    public function create_big_hero()
    {
        return view('ads.create_big_hero');
    }

    public function load_page($page_name)
    {
        switch ($page_name) {
            case 'top_page':
                $data['title'] = "Top Page";
                break;
            case 'below_headline':
                $data['title'] = "Below Headline";
                break;
            case 'in_article_list':
                $data['title'] = "In Article List";
                break;
            case 'footer':
                $data['title'] = "Footer";
                break;
            default:
                break;
        }
        $data['ads'] = Ad::get();
        return view('ads.pages.list', $data);
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
        $this->validate($request, [
            'title' => 'required',
            'value' => 'required',
            'type' => 'required',
        ]);

        Ad::create([
            'title' => $request->title,
            'value' => $request->value,
            'type' => $request->type,
            'position' => 'scripts',
        ]);

        return redirect()->route('ads.index')->with('success', 'Ad created successfully.');
    }

    public function store_big_hero(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'image' => 'required_if:type,img|image|mimes:jpeg,png,jpg,gif|max:2048',
            'script' => 'required_if:type,script',
        ]);

        if ($request->type == 'img') {
            $value = 'big_hero.jpeg';
            $path = Storage::putFileAs('public/ads', $request->file('image'), $value);
        } else {
            $value = $request->script;
        }

        Ad::create([
            'title' => $request->title,
            'value' => $value,
            'type' => $request->type,
            'position' => 'big_hero',
        ]);

        return redirect()->route('ads.index')->with('success', 'Ad created successfully.');
    }

    public function clear_big_hero()
    {
        Ad::where('position', 'big_hero')->delete();
        return redirect()->route('ads.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'image' => 'required_if:type,img|image|mimes:jpeg,png,jpg,gif|max:2048',
            'script' => 'required_if:type,script',
        ]);

        if ($request->type == 'img') {
            $value = date('dmYhis') . '.jpeg';
            $path = Storage::putFileAs('public/ads', $request->file('image'), $value);
        } else {
            $value = $request->script;
        }

        Ad::create([
            'title' => $request->title,
            'value' => $value,
            'type' => $request->type,
            'position' => 'small',
        ]);

        return redirect()->route('ads.index')->with('success', 'Ad created successfully.');
    }

    // Metode edit dan update untuk small ads disertakan dalam contoh di atas.

    public function edit_script($ad)
    {
        $data['ad'] = Ad::find($ad);
        return view('ads.edit_script', $data);
    }

    public function update_script(Request $request, Ad $ad)
    {
        $this->validate($request, [
            'title' => 'required',
            'value' => 'required',
            'type' => 'required',
        ]);

        $ad->update([
            'title' => $request->title,
            'value' => $request->value,
            'type' => $request->type,
            'position' => 'scripts',
        ]);

        return redirect()->route('ads.index')->with('success', 'Ad updated successfully.');
    }

    public function destroy(Ad $ad)
    {
        $ad->delete();

        return redirect()->route('ads.index')->with('success', 'Ad deleted successfully.');
    }
}
