<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class TweetController extends Controller
{
    public function returnRandomTweet(){
        return Tweet::inRandomOrder()->first(['creator', 'text', 'created_at']);
    }

    public function returnTweets($id){
        $id=intval($id);
        return Tweet::where('creator', $id)->get(['creator', 'text', 'created_at']);
    }


    public function addTweet(Request $request)
    {
        $validator = Validator::make($request->all(), ['text' => 'required|string|max:140']);

        if ($validator->fails()){
            return back()->with('Error', 'Incorrect Tweet!');
        }

        Tweet::create([
            'creator'=> auth('api')->user()->id,
            'text'=>$request->text,
            ]);

        return back()->with('success', 'Tweet added');
    }
}
