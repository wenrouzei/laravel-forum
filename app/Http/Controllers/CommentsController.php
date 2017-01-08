<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Http\Requests\CommentPostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(CommentPostRequest $request)
    {
        Comments::create(array_merge($request->all(), ['user_id'=>Auth::user()->id]));

        return redirect()->back();
    }
}
