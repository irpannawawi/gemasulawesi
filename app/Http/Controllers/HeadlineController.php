<?php

namespace App\Http\Controllers;

use App\Models\Editorcoice;
use App\Models\Headlinerubrik;
use App\Models\Headlinewp;
use App\Models\Posts;
use App\Models\Rubrik;
use Illuminate\Http\Request;

class HeadlineController extends Controller
{
    //

    public function rubrik_headline($id)
    {
        $data['rubrik'] = Rubrik::find($id);
        $data['headline'] = Headlinerubrik::where('rubrik_id', $id)->first();
        if($data['headline'] != null)
        {
            $post = $data['headline']->post;
            $img_tag = get_string_between($post->article, '<img src="', '">');
            $img_url = $img_tag;
        }else{
            $img_url = null;
        }
        $data['img_url'] = $img_url;
        return view('web-management.headline-rubrik.index', $data);
    }

    public function select_article($rubrik_id)
    {
        $data['posts'] = Posts::where([
            'status'=>'published',
            'category'=>$rubrik_id
            ])->get();
        return view('web-management.headline-rubrik.components.modal_select_article', $data);
    }

    public function select_all_article()
    {
        $data['posts'] = Posts::where([
            'status'=>'published',
            ])->get();
        return view('web-management.headline-rubrik.components.modal_select_article', $data);
    }

    public function rubrik_headline_change($rubrik_id, $post_id)
    {
        $headline = Headlinerubrik::updateOrCreate(
            ['rubrik_id'=>$rubrik_id],
            ['post_id'=>$post_id]
        );
        // $data['post_image'] = get_string_between($post->article);
        return redirect()->back();
    }

    public function wp_headline_change($wpid, $post_id)
    {
        $headline = Headlinewp::updateOrCreate(
            ['headline_wp_id'=>$wpid],
            ['post_id'=>$post_id]
        );
        // $data['post_image'] = get_string_between($post->article);
        return redirect()->back();
    }

    public function rubrik_headline_delete($rubrik_id)
    {
        $headline = Headlinerubrik::where(
            ['rubrik_id'=>$rubrik_id]
        )->delete();
        // $data['post_image'] = get_string_between($post->article);
        return redirect()->route('rubrik-headline-management', ['id'=>$rubrik_id]);
    }


    public function wp_headline($id)
    {
        $data['headline_list'] = Headlinewp::get();
        // dd($data['headline_list']);
        for($i=0; $i<=3; $i++)
        {
            if(!empty($data['headline_list'][$i]))
            {
                $data['headline'][$i] = $data['headline_list'][$i];
                $post = $data['headline_list'][$i]->post;
                $data['headline'][$i]['img_url'] = get_string_between($post->article, '<img src="', '">'); 

            }else{
                $data['headline'][$i] = null;
                // $post = $data['headline_list'][$i]->post;
                $data['headline'][$i]['img_url'] = null; 
                
            }

        }
        return view('web-management.headline-wp.index', $data);
    }

    public function editor_choice()
    {
        $data['editor_choice'] = Editorcoice::get();
        // dd($data['headline_list']);
        for($i=0; $i<=5; $i++)
        {
            if(!empty($data['editor_choice'][$i]))
            {
                $data['headline'][$i] = $data['editor_choice'][$i];
                $post = $data['editor_choice'][$i]->post;
                $data['headline'][$i]['img_url'] = get_string_between($post->article, '<img src="', '">'); 

            }else{
                $data['headline'][$i] = null;
                // $post = $data['headline_list'][$i]->post;
                $data['headline'][$i]['img_url'] = null; 
                
            }

        }
        return view('web-management.editor-choice.index', $data);
    }

    public function editor_choice_change($wpid, $post_id)
    {
        $headline = Editorcoice::updateOrCreate(
            ['editor_choice_id'=>$wpid],
            ['post_id'=>$post_id]
        );
        // $data['post_image'] = get_string_between($post->article);
        return redirect()->back();
    }
}
