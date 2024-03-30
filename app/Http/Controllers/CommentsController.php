<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{

    public function index(){
        $comments=Comment::all();
        return view('admin/comments/index')->with('comments',$comments);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'comment'=>['required']
        ]);

        $comment=new Comment();
        $comment->user_id=auth()->user()->id;
        $comment->product_id=$request->product_id;
        $comment->comment=$request->comment;

        $comment->save();

        session()->flash('successComment','نظر شما با موفقيت ثبت گرديد');
        return back();
    }

    public function changeStatus($commentID){
        $comment=Comment::findOrFail($commentID);
        if($comment->status==0){
            $comment->status=1;
            $comment->update();
        }
        else{
            $comment->status=0;
            $comment->update();
        }
        return back();
    }

    public function edit($id){
        $comment=Comment::findOrFail($id);
        return view('admin/comments/edit')->with('comment',$comment);
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'comment'=>['required']
        ]);

        $comment=Comment::findOrFail($id);
        $comment->comment=$request->comment;
        $comment->update();

        session()->flash('success','نظر با موفقیت ویرایش گردید');

        return redirect(route('comments.index'));
    }

    public function destroy($id){
        $comment=Comment::findOrFail($id);
        $comment->delete();

        session()->flash('success','نظر با موفقیت حذف گردید');
        return back();
    }

    public function sendReply(Request $request,$id){

        $this->validate($request,[
            'reply'=>['required']
        ]);


        $comment=new Comment();
        $comment->user_id=auth()->user()->id;
        $comment->product_id=$request->product_id;
        $comment->comment=$request->reply;
        $comment->parent_id=$id;
        $comment->status=1;

        $comment->save();

        session()->flash('succSendReply','پاسخ شما ارسال شد');

        return back();

    }
}
