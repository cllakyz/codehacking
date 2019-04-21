<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$year = Carbon::now()->year;
        $posts = Post::paginate(3);
        $categories = Category::all();

        return view('front.home', compact('posts', 'categories'));
    }

    public function post($slug)
    {
        $post = Post::findBySlugOrFail($slug);
        $comments = $post->comments()->whereStatus(1)->get();
        $categories = Category::all();
        return view('front.post', compact('post', 'comments', 'categories'));
    }
}
