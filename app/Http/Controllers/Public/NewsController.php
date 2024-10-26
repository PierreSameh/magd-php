<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function getAll(){
        $news = News::paginate(8);
        return response()->json(["news" => $news], 200);
    }
    public function getFirstThree(){
        $news = News::limit(3)->get();
        return response()->json(["news" => $news], 200);
    }

    public function get(Request $request){
        $validator = Validator::make($request->all(),[
            "news_id" => "required"
        ]);
        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->first()], 500);
        }
        $news = News::find($request->news_id);
        if(!isset($news)){
            return response()->json(["record" => "not found"], 404);
        }
        return response()->json(["record" => $news], 200);

    }
}
