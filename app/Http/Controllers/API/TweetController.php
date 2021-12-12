<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tweet;

class TweetController extends Controller
{
    public function returnRandomTweet(){
        return Tweet::inRandomOrder()->first(['creator', 'text', 'created_at']);
    }

    public function returnTweets($id){
        $id=intval($id);
        return Tweet::where('creator', $id)->get(['creator', 'text', 'created_at']);
    }
}
