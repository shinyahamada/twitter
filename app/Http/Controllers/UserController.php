<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class UserController extends Controller
{
    //

    public function index() {
      $user = User::where('is_deleted',false)->latest()
                                             ->get();

      return $user;
    }

    public function update(Request $request, $id) {

      $user = User::find($id);
      $user->name = $request->name;
      $user->profile = $request->profile;
      $user->password = $request->password;
      $user->email = $request->email;

      $result = $user->save();

      if ($result) {
        return $user;
      }

    }

    public function getUser($id) {
      $user = User::where('users.id', $id)->first();
      return $user;
    }


}
