<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::with('user')->get();
        return view('adm.comments.index',['comments'=>$comments]);
    }

    public function store(Request $request){
        $validated=$request->validate([
            'content'=>'required',
            'shop_id'=>'required|numeric|exists:shops,id'
        ]);

//
        Auth::user()->comments()->create($validated);
        return back()->with('message',__('alerts.comment successfully sent'));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('message',__('alerts.Your comment successfully deleted'));
    }


    public function edit(Comment $comment)
    {
        return view('comment.edit', ['comment' => $comment]);
    }

    public function update(Request $request, Comment $comment)
    {
        $comment->update([
            'content' => $request->input('content'),

        ]);
        return back();
    }
}
