<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $postData = $request->all();
        if($file = $request->file('photo_id')){
            //$fileName = time().$file->getClientOriginalName();
            $fileName = sha1($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
            $file->move('images', $fileName);
            $photo = Photo::create(['file' => $fileName]);
            $postData['photo_id'] = $photo->id;
        }
        $postData['password'] = bcrypt($postData['password']);
        User::create($postData);
        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UsersEditRequest  $request
     * @param  int  $id
     * @return \App\Http\Requests\UsersEditRequest
     */
    public function update(UsersEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if(trim($request->password) == ""){
            $postData = $request->except('password');
        } else{
            $postData = $request->all();
            $postData['password'] = bcrypt($postData['password']);
        }

        if($file = $request->file('photo_id')){
            //$fileName = time().$file->getClientOriginalName();
            $fileName = sha1($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
            $file->move('images', $fileName);
            $photo = Photo::create(['file' => $fileName]);
            $postData['photo_id'] = $photo->id;
        }
        $user->update($postData);
        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        unlink(public_path().$user->photo->file);
        Photo::findOrFail($user->photo_id)->delete();
        $user->delete();
        Session::flash('deleted_user', 'The user has been deleted');
        return redirect(route('admin.users.index'));
    }
}
