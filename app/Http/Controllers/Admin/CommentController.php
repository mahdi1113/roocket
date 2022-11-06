<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::whereApproved(1)->paginate(3);
        return view('admin.comment.index',compact('comments'));
    }

    public function unApproved(Request $request)
    {
        $comments = Comment::query();
        if($keyword = $request->search)
        {
            $comments->where('comment','LIKE',"%{$keyword}%")->orWhereHas('user',function($query) use($keyword){
                $query->where('name','LIKE',"%{$keyword}%");
            });
        }
        $comments = $comments->whereApproved(0)->latest()->paginate(3);
        return view('admin.comment.unApproved',compact('comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    // public function edit(Comment $comment)
    // {
    //     return view('admin.comment.edit',compact('comment'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Comment $comment)
    {
        $comment->update([
            'approved' => 0
        ]);
        $msg = 'کامنت غیرفعال شد';
        return back()->with('success',$msg);
    }

    public function updateUnApproved(Comment $comment)
    {
        $comment->update([
            'approved' => 1
        ]);
        $msg = 'کامنت تایید شد';
        return back()->with('success',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        $msg = 'کامنت حذف شد';
        return back()->with('success',$msg);
    }
}
