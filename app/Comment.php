<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public function auther() {
      return $this->belongsTo('APP\User');
    }
}
