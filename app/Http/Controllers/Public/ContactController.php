<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function send(Request $request){
        $validator = Validator::make($request->all(), [
            "inquiry"=> "required|string|max:255",
            "region"=> "required|string|max:255",
            "phone"=> "required|string|numeric|digits:11",
            "first_name"=> "required|string|max:255",
            "last_name"=> "required|string|max:255",
            "email"=> "required|email",
            "description"=> "required|string|max:1000"
        ]);
        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->first()], 500);
        }
        $message = Contact::create([
            "inquiry" => $request->inquiry,
            "region" => $request->region,
            "phone" => $request->phone,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "description" => $request->description
        ]);

        if($message){
            return response()->json(["message" => "Message Sent Successfully!"], 200);
        }
        
        return response()->json(["message" => "Couldn't Send Your Message, please try again later"], 500);
    }
}
