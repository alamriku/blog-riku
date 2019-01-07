<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request,$blog_id)
    {
        
        $this->validate($request,[
            'user_comment'=>'required'
        ]);
        //we are inserting database in comment table 
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->blog_id = $blog_id;
        $comment->user_name = $request->user_name;
        $comment->comment = $request->user_comment;
        $comment->publication_status = $request->publication_status;
        $comment->save();
        
         Session::put('message','Admin will approve your comment');
         return redirect()->back();
    }
}
