<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class UserController extends Controller
{
    //

    public function index() {
      $user = User::where([
        ['is_deleted', false]
      ]);

      return ['data'=>$user];
    }

    public function update(Request $request) {

      $user = User::find($request->id);
      $user->name = $request->name;
      $user->profile = $request->profile;
      $path = $request->file('image')->store('public');
      $user->image = basename($path);

      $user->save();

      return ['result'=>1000];


    }
}
