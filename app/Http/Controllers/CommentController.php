<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->merge(['user_id' => Auth::user()->id]);
        Comments::create($request->validate([
                'content' => 'required|min:3',
                'article_id' => 'required',
                'user_id' => 'required',
                'comment_reply_id' => 'nullable',
            ])
        );
        return redirect()->back()->with('success', 'Comment was created');
    }
}
