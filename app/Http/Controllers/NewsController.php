<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    
    function get_news($id = 0){
        $user = auth('api')->user();
 
        if(is_numeric($id)){
            $news =  $id ? News::find($id)->where('is_approved', '1') : News::where('is_approved', '1') ->where('age','<', $user->age) ->get();
            return response()->json([
                'news'=>$news,
                'message'=>'',
            ]);
        }
        return response()->json([
            'news'=>null,
            'message'=>'check news id',
        ],400);
    }
    function add_news(Request $request) {

        $validated = $request->validate([
            'user_id' => 'required|integer',
            'title' => 'required|unique:news|max:255',
            'content' => 'required',
            'is_approved' => 'required',
        ]);
        $path = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads', 'public');
        }

        $news = News::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'content' => $request->content,
            'is_approved' => $request->is_approved,
            'path' => $path,
        ]);
            return response()->json([
            "news" => $news,
            'message'=>'succ',
        ]);
    }

    function update_news($id,Request $request) {

        $validated = $request->validate([
            'user_id' => 'required|integer',
            'title' => 'required|unique:news|max:255',
            'content' => 'required',
            'is_approved' => 'required',
        ]);
        $news = News::where('id', $id)->update($request->all());
        return response()->json([
            "news" => $news,
            'message'=>'succ update',
        ]);
    }
    function delete_news($id) {
        if(is_numeric($id)){
            $news = News::where('id', $id)->delete();
            return response()->json([
                "news" => $news,
                'message'=>'succ delete',
            ]);
        }
        return response()->json([
            'news'=>null,
            'message'=>'check news id',
        ],400);
    }

}
