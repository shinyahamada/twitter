<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FollowUser extends Pivot
{
    //
    protected $table = follow_users;
    public $timestamps = false;

    public function followUsers() {
      return $this->belongsToMany(self::class, 'follow_users','user_id','followed_user_id')
                  ->using(FollowUser::class);
    }

    public function store(Request $request) {
      $followedUser = User::findOrFail($request->id);
      FollowUser::firstOfCreate([
        'user_id' => Auth::id(),
        'followed_user_id' => $followedUser->id,
      ]);

      return response()->json(['result'=>true]);
    }

    public function destroy($id) {
      $followedUser = User::findOrFail($id);
      $user = Auth::user();
      $user->followedUsers()->detach($followedUser->id);
      return response()->json(['result'=>true]);
    }
}
