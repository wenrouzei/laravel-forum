<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('liked', function (Request $request){
    $liked = \App\Models\Discussion::findOrFail($request->input('like'))->likes()->where('user_id', $request->input('user'))->count();

    return response()->json(['liked'=>($liked?true:false)]);
})->middleware('api');

Route::post('like', function (Request $request){
    $liked = \App\Models\Discussion::findOrFail($request->input('like'))->likes()->where('user_id', $request->input('user'))->first();
    if (!is_null($liked)) {
        $liked->delete();
        \App\Models\Discussion::findOrFail($request->input('like'))->decrement('like_count', 1);
        return response()->json(['liked'=>false]);
    } else {
        \App\Models\Discussion::findOrFail($request->input('like'))->likes()->create(['user_id' => $request->input('user')]);
        \App\Models\Discussion::findOrFail($request->input('like'))->increment('like_count', 1);
        return response()->json(['liked'=>true]);
    }

})->middleware('api');
