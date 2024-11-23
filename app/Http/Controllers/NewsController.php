<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    
    function get_news($id = 0){
        if(is_int($id)){
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
}
