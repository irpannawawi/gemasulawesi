<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function index()
    {

        return view('ads.index');
    }

    public function load_page($page_name)
    {
        $data['alert'] = '';
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
                // Sidebar
            case 'above_sidebar':
                $data['title'] = "Above Sidebar";
                break;
            case 'below_sidebar':
                $data['title'] = "Below Sidebar";
                break;

                // single page
            case 'above_content':
                $data['title'] = "Above Content";
                break;
            case 'below_heading':
                $data['title'] = "Below Heading";
                break;
            case 'content':
                $data['title'] = "Content";
                $data['alert'] = "Gunakan gambar dengan ukuran 600x350px";
                break;
            case 'below_content':
                $data['title'] = "Below Content";
                break;
            // pop up
                case 'pop_up':
                    $data['title'] = "Pop Up Ad";
                    break;

            // head html
            case 'html_script':
                $data['title'] = "HTML Script";
                break;
            default:
                break;
        }

        $data['page_name'] = $page_name;
        $data['ads'] = Ad::where('position', $page_name)->get();
        return view('ads.pages.list', $data);
    }

    public function store_script(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'value' => 'required'
        ]);

        Ad::create([
            'title' => $request->title,
            'value' => $request->value,
            'type' => $request->type,
            'link' => $request->link,
            'position' => $request->page_name,
        ]);

        return redirect()
            ->route('ads.index')
            ->with('last_load', $request->page_name)
            ->with('success', 'Ad created successfully.');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'image' => 'required_if:type,img|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $value = date('Ymdhis') . '.jpeg';
        $path = Storage::putFileAs('public/ads', $request->file('image'), $value);


        Ad::create([
            'title' => $request->title,
            'value' => $value,
            'type' => $request->type,
            'link' => $request->link,
            'position' => $request->page_name,
        ]);

        return redirect()
            ->route('ads.index')
            ->with('last_load', $request->page_name)
            ->with('success', 'Ad created successfully.');
    }



    // Metode edit dan update untuk small ads disertakan dalam contoh di atas.



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
        $page = $ad->position;
        $ad->delete();

        return redirect()
            ->route('ads.index')
            ->with('last_load', $page)
            ->with('success', 'Ad deleted successfully.');
    }
}
