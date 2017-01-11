<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\CommentPostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(CommentPostRequest $request)
    {
        $comment = Comment::create(array_merge($request->all(), ['user_id'=>Auth::user()->id]));

        if($request->ajax() && !is_null($comment)){
            return ['success'=>true];
        }

        return redirect()->back();
    }
}
