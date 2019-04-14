<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminPhotosController extends Controller
{
    public function index()
    {
        $photos = Photo::all();
        return view('admin.media.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $fileName = sha1($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
        $file->move('images', $fileName);
        Photo::create(['file' => $fileName]);

    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        unlink(public_path().$photo->file);
        $photo->delete();
        Session::flash('deleted_photo', 'The photo has been deleted');
        return redirect()->back();
    }

    public function deleteMedias(Request $request)
    {
        $photos = Photo::findOrFail($request->checkBoxArray);
        foreach ($photos as $photo){
            unlink(public_path().$photo->file);
            $photo->delete();
        }
        return redirect()->back();
    }
}
