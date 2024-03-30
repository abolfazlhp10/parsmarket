<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePosterRequest;
use App\Http\Requests\UpdatePosterRequest;
use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostersController extends Controller
{
    public function index()
    {
        $posters = Poster::all();
        return view('admin/posters/index')->with('posters', $posters);
    }

    public function create()
    {
        return view('admin/posters/create');
    }

    public function store(CreatePosterRequest $request)
    {

        $poster = new Poster();
        $poster->name = $request->name;
        $poster->image = $request->image->store('posters');
        $poster->url = $request->url;

        $poster->save();

        session()->flash('success', 'پوستر با موفقیت اضافه گردید');
        return redirect(route('posters.index'));
    }

    public function edit($id)
    {
        $poster=Poster::findOrFail($id);
        return view('admin/posters/create')->with('poster',$poster);
    }

    public function update(UpdatePosterRequest $request,$id)
    {
        $poster=Poster::findOrFail($id);
        $poster->name=$request->name;
        $poster->url=$request->url;
        if ($request->hasFile('image')) {
            Storage::delete($poster->image);
            $poster->image=$request->image->store('posters');
        }
        $poster->save();



        session()->flash('success', 'پوستر با موفقیت ویرایش گردید');
        return redirect(route('posters.index'));

    }

    public function destroy($id)
    {
        $poster=Poster::findOrFail($id);
        Storage::delete($poster->image);
        $poster->delete();


        session()->flash('success', 'پوستر با موفقیت حذف گردید');
        return redirect(route('posters.index'));
    }
}
