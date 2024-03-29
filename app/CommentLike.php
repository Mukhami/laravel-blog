<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    protected $fillable = ['comment_id', 'user_id'];

    public function comment(){
        return $this->belongsTo('App\Comment', 'post_id');
    }

    public function user(){
        return $this->hasOne('App\User', 'user_id');
    }
}
