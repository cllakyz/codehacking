<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $postData = $request->all();
        $user = Auth::user();
        if($file = $request->file('photo_id')){
            $fileName = sha1($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
            $file->move('images', $fileName);
            $photo = Photo::create(['file' => $fileName]);
            $postData['photo_id'] = $photo->id;
        }
        $user->posts()->create($postData);
        return redirect(route('admin.posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::lists('name', 'id')->all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $postData = $request->all();
        if($file = $request->file('photo_id')){
            $fileName = sha1($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
            $file->move('images', $fileName);
            $photo = Photo::create(['file' => $fileName]);
            $postData['photo_id'] = $photo->id;
        }
        Auth::user()->posts()->whereId($id)->first()->update($postData);
        return redirect(route('admin.posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        unlink(public_path().$post->photo->file);
        Photo::findOrFail($post->photo_id)->delete();
        $post->delete();
        Session::flash('deleted_post', 'The post has been deleted');
        return redirect(route('admin.posts.index'));
    }

    public function post($id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->comments()->whereStatus(1)->get();
        return view('post', compact('post', 'comments'));
    }
}
