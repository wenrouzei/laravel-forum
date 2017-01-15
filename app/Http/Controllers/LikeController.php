<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $id)
    {
       // $type = $request->input('type');
        $type = 'Discussion';
        //$id = $request->input('id');

        if($type == 'Comment') {
            $target = Comment::findOrFail($id);
        }elseif($type == 'Discussion'){
            $target = Discussion::findOrFail($id);
        }

        if(!is_null($target)) {
            if ($target->likes()->where('user_id', Auth::id())->count()) {
                $target->likes()->where('user_id', Auth::id())->delete();
                $target->decrement('like_count', 1);
            } else {
                $target->likes()->create(['user_id' => Auth::id()]);
                $target->increment('like_count', 1);
            }

            //return Response::json(['like' => $target->likes->count()]);
            return back();
        }
    }
}
