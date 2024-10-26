<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkController extends Controller
{
    public function getAll(){
        $ourWork = Work::paginate(9);
        return response()->json(["our_work" => $ourWork], 200);
    }
    public function getFirstThree(){
        $ourWork = Work::limit(3)->get();
        return response()->json(["our_work" => $ourWork], 200);
    }

    public function get(Request $request){
        $validator = Validator::make($request->all(),[
            "work_id" => "required"
        ]);
        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->first()], 500);
        }
        $work = Work::find($request->work_id);
        return response()->json(["record" => $work], 200);

    }
}
