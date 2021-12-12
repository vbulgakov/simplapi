<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function editUser(){

        $user_array=User::where('id', auth('api')->user()->id )->get(['id','name', 'birthdate'])->toArray();

        $user_array[0]['avatar_url']=asset('storage').'/'.config('assets.user_image_path').'/'.$user_array[0]['id'].'.jpg';
        unset ($user_array[0]['id']);

        return $user_array;
    }

    public function updateUser(Request $request){

        $user_id=auth('api')->user()->id;

        $validate_name = Validator::make($request->all(), ['name' => 'required|string|max:255']);
        if ($validate_name->fails()){
            return back()->with('Error', 'Incorrect name.');
        }
        else{
            User::where('id', $user_id )->update(['name'=>$request->name]);
        }

        $validate_date = Validator::make($request->all(), ['date' => 'required|date']);
        if ($validate_date->fails()){
            return back()->with('Error', 'Incorrect date.');
        }
        else{
            User::where('id', $user_id )->update(['birthdate'=>$request->date]);
        }

        $validator = Validator::make($request->all(), ['image' => 'required|image:jpeg|max:1024']);
        if ($validator->fails()){
            return response('error', 500);
        }
        $image = $request->file('image');
        $image->storeAs(config('assets.user_image_path'),$user_id.'.jpg','public');

        return back()->with('success', 'Your data updated.');
    }

}
