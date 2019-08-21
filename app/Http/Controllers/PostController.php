<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\Comment;
use App\Like;
use App\Notifications\LikePost;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use Illuminate\Session\Store;

class PostController extends Controller
{
    public function getIndex()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('blog.index', ['posts' => $posts]);
    }
    public function getExploreIndex()
    {
        $posts = Post::orderBy('created_at', 'desc');
        return view('blog.explore', ['posts' => $posts]);
    }

    public function getAdminIndex()
    {
        $user_id=Auth::user()->id;
        $user  = User::where('id', '=', $user_id)->firstOrFail();
        $posts =Post::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        return view('admin.index', compact('posts', 'user'));
    }

    public function getPost($slug, Request $request)
    {
        $comment_id = Comment::find($request->id);
        $post = Post::where('slug', '=', $slug)->firstOrFail();
        return view('blog.post', compact('post', 'comment_id'));
    }
    public function getLikePost(Request $request, $id)
    {

//        dd($request);
        $user =Auth::user();
        $user_id=Auth::user()->id;
        $auth = User::findOrFail($request->user_id);
//        dd($auth);
        $liked = Like::where('post_id', $id)->where('user_id', $user_id)->value('post_id');
        if($liked != $id) {
            $like = Like::create([
                'user_id' => $user_id,
                'post_id' => $id,
            ]);
            $like->save();


            $auth->notify(new LikePost($user, Post::findOrFail($id)));
            return redirect()->back();
        }
        return redirect()->back()->with('info', 'You already liked this post');
    }

    public function getAdminCreate()
    {
        $tags = Tag::all();
        return view('admin.create', ['tags'=> $tags]);
    }

    public function getAdminEdit($id)
    {
        $post = Post::where('id', '=', $id)->firstOrFail();
        $tags = Tag::all();
        return view('admin.edit', ['post' => $post, 'postId' => $id, 'tags' => $tags]);
    }

//    public function check_slug(Request $request)
//    {
//        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
//        return response()->json(['slug' => $slug]);
//    }

//    public function tagAdminCreate(Request $request)
//    {
//        $request->has('tag-create');
//        $this->validate($request, [
//            'name' => 'required',
//        ]);
//        $tag = new Tag(['name'=> $request->input('name')]);
//        $tag->save();
//        return redirect()->route('admin.create')->with('info', 'Tag created');
//    }

    public function postAdminCreate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);

        $user_id = Auth::user()->id;
        $title = $request->input('title');
        $post = new Post([
            'user_id' => $user_id,
            'title' => $title,
            'slug' => str_slug($title, '-')."-p=".str_random(5),
            'content' =>$request->input('content')

        ]);
//        dd($post);
        $post->save();
        $post->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));
        return redirect()->route('admin.index')->with('info', 'Post created, Title is: ' . $request->input('title'));

    }

    public function getAdminDelete($slug)
    {
        $post = Post::where('slug', '=', $slug)->firstOrFail();
        $post->likes()->delete();
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.index')->with('info', 'Post was successfully deleted.');
    }

    public function postAdminUpdate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $post = Post::find($request->input('id'));
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        $post->tags()->sync($request->input('tags') === null ? [] : $request->input('tags'));
        return redirect()->route('admin.index')->with('info', 'Post edited, new Title is: ' . $request->input('title'));
    }
//SEARCH POST
    public function searchPost(Request $request)
    {
        $query = $request->input('query');
        $user_name = 'user_id';

        $users = User::where('name', 'like', "%$query%")->get();

        $posts = Post::where('title', 'like', "%$query%")
            ->orWhere('content', 'like', "%$query%")
            ->orWhere($user_name, 'like', "%$query%")
            ->get();
        return view('blog.search-results', compact('query', 'posts', 'users'));
    }

//BOOKMARK FUNCTIONS

    public function getBookmarksindex()
    {
        $user_id=Auth::user()->id;
        $bookmarks=Bookmark::where('user_id', $user_id)->get();
        return view('blog.bookmarks',compact('bookmarks'));
    }

    public function createBookmark($id)
    {
        $user_id=Auth::user()->id;
        $bookmarked = Bookmark::where('post_id',$id)
            ->where('user_id', $user_id)
            ->value('post_id');

        if($bookmarked != $id) {
            $bookmark = Bookmark::create([
                'user_id' => $user_id,
                'post_id' => $id,
            ]);
            $bookmark->save();
            return redirect()->back()->with('info', 'Post has been added to your bookmarks');
        }
        return redirect()->back()->with('info', 'Post already exists in your bookmarks');
    }

    public function destroyBookmark($id)
    {
        Bookmark::where('id' , $id)->delete();
        return redirect()->back()->with('info', 'Item has successfully been removed from your bookmarks');
    }

}
