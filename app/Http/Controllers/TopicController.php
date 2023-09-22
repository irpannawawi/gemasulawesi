<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    //

    public function modal_topic()
    {
        $data['topics'] = Topic::orderBy('topic_id', 'DESC')->get();
        return view('editorial.components.modal_topics', $data);
    }

    public function insert(Request $request)
    {
        $topicData = [
            'topic_name'=>$request->topic_name,
            'topic_description'=>$request->topic_description,
            'topic_image'=>'-',//$request->topic_image,
        ];
        if(Topic::create($topicData))
        {
            return redirect()->back()->with('message-success', 'Berhasil menambah tag');
        }
    }

    public function edit(Request $request)
    {
        if(Topic::where('topic_id', $request->topic_id)->update(['topic_name'=>$request->topic_name]))
        {
            return redirect()->back()->with('message-success', 'Berhasil menambah tag');
        }
    }

    public function delete($id)
    {
        if(Topic::where('topic_id', $id)->delete())
        {
            return redirect()->back()->with('message-success', 'Berhasil menghapus tag');
        }
    }
}
