<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('dashboard')->with('posts', $posts);
    }

    public function like(Request $request)
    {
        $post_id = $request->post_id;
        $post =Post::findOrFail($post_id);
        $user = auth()->user();
        $is_like = $request->like != "false" ;
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            if ($is_like== $like->like) {
                $like->delete();
            } else {
                $like->like = $is_like;
                $like->save();
            }
            return ;
        } else {
            $like = new Like();
            $like->user_id = auth()->user()->id;
            $like->like = $is_like;
            $like->post_id = $post_id;
            $like->save();
            return ;
        }
    }
}
