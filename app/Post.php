<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    protected $appends = [
      'likes_count', 'liked_by_user'
    ];

    public function comments() {
      return $this->hasMany('App\Comment')->orderBy('id','desc');
    }

    public function user() {
      return $this->belongsTo('App\user','user_id','id','users');
    }

    public function likes(){
      return $this->belongsToMany('App\User','likes')->withTimestamps();
    }

    // likeの数
    public function getLikesCountAttribute() {
      return $this->likes()->count();
    }
    // このユーザに既にいいねされているかどうか
    public function getLikedByUserAttribute() {

      if (Auth::guest()) {
        return false;
      }
      return $this->likes->contains(function ($user) {
        return $user->id === Auth::user()->id;
      });
    }
}
