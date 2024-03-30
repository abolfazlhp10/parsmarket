<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('admin/tags/index')->with('tags', $tags);
    }

    public function create()
    {
        return view('admin/tags/create');
    }

    public function store(CreateTagRequest $request){

        $tag=new Tag();
        $tag->name=$request->tag;
        $tag->save();

        session()->flash('success','برچسب با موفقیت اضافه گردید');
        return redirect(route('tags.index'));

    }

    public function edit($id){
        $tag=Tag::findOrFail($id);
        return view('admin/tags/create')->with('tag',$tag);
    }

    public function update(UpdateTagRequest $request,$id){
        $tag=Tag::findOrFail($id);
        $tag->name=$request->tag;
        $tag->update();

        session()->flash('success','برچسب با موفقیت ویرایش گردید');
        return redirect(route('tags.index'));

    }

    public function destroy($id){
        $tag=Tag::findOrFail($id);
        $tag->delete();

        session()->flash('success','برچسب با موفقیت حذف گردید');
        return redirect(route('tags.index'));
    }
}
