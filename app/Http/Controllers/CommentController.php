<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentLike;
use App\Like;
use App\Notifications\CommentPost;
use App\Notifications\LikePost;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'body'=>'required',
        ]);

        $user = Auth::user();
        $auth = User::findOrFail($request->user_id);
        $comment = new Comment;
        $comment->body = $request->get('body');
        $comment->user()->associate($request->user());
        $post = Post::find($request->get('post_id'));
        $post->comments()->save($comment);

        $auth->notify(new CommentPost($user, $post, Comment::findOrFail($id)));

        return back();
    }

    public function LikeComment(Request $request, $id)
    {
//        $user =Auth::user();
        $user_id=Auth::user()->id;
//        $auth = User::findOrFail($request->user_id);
        $liked = CommentLike::where('comment_id', $id)->where('user_id', $user_id)->value('comment_id');
        if($liked != $id) {
            $like = CommentLike::create([
                'user_id' => $user_id,
                'comment_id' => $id,
            ]);
            $like->save();
//            $auth->notify(new LikePost($user, Post::findOrFail($id)));
            return redirect()->back();
        }
        return redirect()->back()->with('info', 'You already liked this comment');
    }

}
