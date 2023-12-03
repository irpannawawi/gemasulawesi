<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    //

    public function topik_khusus(Request $request)
    {
        $q = $request->q;
        $topicsQuery = Topic::orderBy('topic_id', 'desc');
        if($q!=''){
            $topicsQuery = $topicsQuery->where('topic_name', 'like', '%'.$q.'%');
        }
        $data['topiks'] = $topicsQuery->get();
        return view('web-management.topik-khusus.index', $data);
    }

    public function modal_topic(Request $request)
    {
        $q = $request->q;
        $topicsQuery = Topic::orderBy('topic_id', 'desc');
        if($q!=''){
            $topicsQuery = $topicsQuery->where('topic_name', 'like', '%'.$q.'%');
        }
        $data['topics'] = $topicsQuery->get();
        return view('editorial.components.modal_topics', $data);
    }

    public function insert(Request $request)
    {
        $filename = date('dmY') . '.jpg';
        $topicData = [
            'topic_name' => $request->topic_name,
            'slug' => Str::slug($request->topic_name),
            'topic_description' => $request->topic_description,
            'topic_image' => $filename
        ];

        // upload image
        $path = $request->file('topic_image')->storeAs('public/topic-images', $filename);

        if (Topic::create($topicData)) {
            return redirect()->back()->with('success', 'Berhasil menambah topik');
        }
    }

    public function edit(Request $request)
    {
        $topic = Topic::find($request->topic_id);
        if ($request->file('topic_image')) {
            $filename = date('dmYHis') . '.jpg';
            $request->file('topic_image')->storeAs('public/topic-images', $filename);
            // remove old image
            Storage::delete('public/topic-images/' . $topic->topic_image);
            $topic->topic_image = $filename;
        }

        $topic->topic_name = $request->topic_name;
        $topic->topic_description = $request->topic_description;

        if ($topic->save()) {
            return redirect()->back()->with('success', 'Berhasil merubah topik');
        }
    }

    public function delete($id)
    {
        if (Topic::where('topic_id', $id)->delete()) {
            return redirect()->back()->with('success', 'Berhasil menghapus topik');
        }
    }
}
