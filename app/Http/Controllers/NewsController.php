<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    
    function get_news($id = 0){
        if(is_int($id)){
            $news =  $id ? News::find($id):News::all();
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
}
