<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    
    function get_news($id = 0){
        if(is_numeric($id)){
            $news =  $id ? News::find($id)->where('is_approved', '1') : News::all()->where('is_approved', '1');
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
        $news = News::create($request->all());
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
