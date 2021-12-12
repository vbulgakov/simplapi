<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function editUser($id){
        return User::where('id', $id)->get(['id','name', 'birthdate']);
    }

}
