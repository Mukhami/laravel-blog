<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    protected $fillable = ['title','user_id', 'slug', 'content'];

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag', 'post_tag', 'post_id', 'tag_id')->withTimestamps();
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function bookmarks(){
        return $this->hasMany('App\Bookmark' ,'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

//    use Sluggable;
//    /**
//     * Return the sluggable configuration array for this model.
//     *
//     * @return array
//     */
//    public function sluggable()
//    {
//        return [
//            'slug' => [
//                'source' => 'title'
//            ]
//        ];
//    }
}