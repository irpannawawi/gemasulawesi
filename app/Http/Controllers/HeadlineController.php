<?php

namespace App\Http\Controllers;

use App\Models\Editorcoice;
use App\Models\Headlinerubrik;
use App\Models\Headlinewp;
use App\Models\Posts;
use App\Models\Rubrik;
use Illuminate\Console\View\Components\Choice;
use Illuminate\Http\Request;
use App\Http\Controllers\EditorialController;
use Carbon\Carbon;

class HeadlineController extends Controller
{
    //

    public function rubrik_headline($id)
    {
        $data['rubrik'] = Rubrik::find($id);
        $data['headline'] = Headlinerubrik::where('rubrik_id', $id)->first();
        if ($data['headline'] != null) {
            $post = $data['headline']->post;
            $img_tag = get_string_between($post->article, '<img src="', '">');
            $img_url = $img_tag;
        } else {
            $img_url = null;
        }
        $data['img_url'] = $img_url;
        return view('web-management.headline-rubrik.index', $data);
    }

    public function select_article(Request $request, $rubrik_id)
    {
        $posts = $this->getPost($request, 'published');
        $data['posts'] = $posts->paginate(20);
        return view('web-management.headline-rubrik.components.modal_select_article', $data);
    }

    public function select_all_article(Request $request) {
        $q = $request->q;
        $rubrik = $request->rubrik;
        if($rubrik==null)
        {
            $rubrik='';
        }
        $data['rubrikId'] = $rubrik;
        $posts = $this->getPost($request, 'published');
        $data['posts'] = $posts->paginate(20);
        return view('web-management.headline-rubrik.components.modal_select_article', $data);
    }

    public function rubrik_headline_change($rubrik_id, $post_id)
    {
        $headline = Headlinerubrik::updateOrCreate(
            ['rubrik_id' => $rubrik_id],
            ['post_id' => $post_id]
        );
        // $data['post_image'] = get_string_between($post->article);
        return redirect()->back();
    }

    public function wp_headline_change($wpid, $post_id)
    {
        $headline = Headlinewp::updateOrCreate(
            ['headline_wp_id' => $wpid],
            ['post_id' => $post_id]
        );
        // $data['post_image'] = get_string_between($post->article);
        return redirect()->back();
    }

    public function rubrik_headline_delete($rubrik_id)
    {
        $headline = Headlinerubrik::where(
            ['rubrik_id' => $rubrik_id]
        )->delete();
        // $data['post_image'] = get_string_between($post->article);
        return redirect()->route('rubrik-headline-management', ['id' => $rubrik_id]);
    }


    public function wp_headline()
    {
        $data['headline_list'] = Headlinewp::orderBy('headline_wp_id', 'ASC')->get();

        $data['headline'] = [0, 1, 2, 3];

        foreach ($data['headline_list'] as $key => $headlineItem) {
            $data['headline'][$headlineItem->headline_wp_id] = $headlineItem;

            $post = $headlineItem->post;

            if (!empty($post)) {
                $data['headline'][$headlineItem->headline_wp_id]['img_url'] = get_string_between($post->article, '<img src="', '">');
            } else {
                $data['headline'][$headlineItem->headline_wp_id]['img_url'] = null;
            }
        }
        return view('web-management.headline-wp.index', $data);
    }

    public function wp_headline_delete($headline_id)
    {
        $headline = Headlinewp::where(
            ['headline_wp_id' => $headline_id]
        )->delete();
        // $data['post_image'] = get_string_between($post->article);
        return redirect()->route('wp-headline-management');
    }

    public function editor_choice()
    {

        $data['editor_choice'] = Editorcoice::with('post')->get();
        $data['headline'] = [0,1,2,3,4,5];

        foreach ($data['editor_choice'] as $key => $editorChoiceItem) {
            if (!empty($editorChoiceItem->post)) {
                $data['headline'][$editorChoiceItem->editor_choice_id] = $editorChoiceItem;
                $post = $editorChoiceItem->post;
                $data['headline'][$editorChoiceItem->editor_choice_id]['img_url'] = get_string_between($post->article, '<img src="', '">');
            } else {
                $data['headline'][$editorChoiceItem->editor_choice_id] = null;
                $data['headline'][$editorChoiceItem->editor_choice_id]['img_url'] = null;
            }
        }


        // $data['editor_choice'] = Editorcoice::get();

        // for ($i = 0; $i <= 5; $i++) {
        //     if (!empty($data['editor_choice'][$i]->post)) {
        //         $data['headline'][$i] = $data['editor_choice'][$i];
        //         $post = $data['editor_choice'][$i]->post;
        //         $data['headline'][$i]['img_url'] = get_string_between($post->article, '<img src="', '">');
        //     } else {
        //         $data['headline'][$i] = null;
        //         // $post = $data['headline_list'][$i]->post;
        //         $data['headline'][$i]['img_url'] = null;
        //     }
        // }
        return view('web-management.editor-choice.index', $data);
    }

    public function editor_choice_change($wpid, $post_id)
    {
        $headline = Editorcoice::updateOrCreate(
            ['editor_choice_id' => $wpid],
            ['post_id' => $post_id]
        );
        // $data['post_image'] = get_string_between($post->article);
        return redirect()->back();
    }

    public function editor_choice_delete($headline_id)
    {
        $headline = Editorcoice::where(
            ['editor_choice_id' => $headline_id]
        )->update(['post_id' => '0']);
        // $data['post_image'] = get_string_between($post->article);
        return redirect()->route('editor-choice');
    }

    public function getPost($request, $status)
    {
        $q = $request->q;
        $data['q'] = $q;

        // chek if sorted
        $posts = Posts::where('status', $status);

        if (!empty($request->sort_by)) {
            $posts = $posts->orderBy( $request->sort_by, $request->order);
        }else{
            $posts = $posts->orderBy('published_at', 'DESC');
        }
        // chek if has query string
        if (!empty($q)) {
            $posts = $posts->where('title', 'LIKE', '%' . $q . '%');
        }
        // chek if filtered category
        if (!empty($request->rubrik)) {
            $posts = $posts->where('category', '=', $request->rubrik);
        }
        // chek if filtered author
        
        if (!empty($request->author)) {
            $posts = $posts->where('author_id', '=', $request->author);
        }
        // chek if filtered date
        if (!empty($request->dates)) {
            $dates = explode(' - ', $request->dates);
            $start_date = Carbon::createFromFormat('m/d/Y', $dates[0])->format('Y-m-d 00:00:00');
            $end_date = Carbon::createFromFormat('m/d/Y', $dates[1])->format('Y-m-d 23:59:59');
            $posts = $posts->whereBetween('published_at', [$start_date, $end_date]);
        }

        return $posts;
    }
}
