<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    function get_article($news_id,$id = 0,$request){
        $validated = $request->validate([
            'news_id' => 'required|integer',
        ]);

        $user = auth('api')->user();
 
        if(is_numeric($id)){
            $article =  $id ? Article::find($id)->where('news_id', $news_id) : Article::where('news_id', $news_id)->where('is_approved', '1')->get();
            return response()->json([
                'article'=>$article,
                'message'=>'',
            ]);
        }
        return response()->json([
            'article'=>null,
            'message'=>'check article id',
        ],400);
    }
    function add_article(Request $request) {

        $validated = $request->validate([
            'news_id' => 'required|integer',
            'user_id' => 'required|integer',
            'title' => 'required|unique:article|max:255',
            'content' => 'required',
            'is_approved' => 'required',
        ]);
        $path = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads', 'public');
        }
        $request->merge(['file' => $path]);

        $article = Article::create($request->all());
        return response()->json([
            "article" => $article,
            'message'=>'succ',
        ]);
    }

}
