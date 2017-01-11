<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function avatar()
    {
        return view('users.avatar');
    }

    public function avatarUpload(Request $request)
    {
        $file = $request->file('avatar');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = Validator::make($input, $rules);
        if ( $validator->fails() ) {
            return Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $destinationPath = 'uploads/';
        $filename = Auth::user()->id.'_'.time().'.'.$file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);
        Image::make($destinationPath.$filename)->fit(400)->save();

        return Response::json(
            [
                'success' => true,
                'avatar' => asset($destinationPath.$filename),
                'image' => $destinationPath.$filename,
            ]
        );
    }

    public function avatarCrop(Request $request)
    {
        $photo = $request->input('photo');
        $width = (int)$request->input('w');
        $height = (int)$request->input('h');
        $xAlign = (int)$request->input('x');
        $yAlign = (int)$request->input('y');

        Image::make($photo)->crop($width, $height, $xAlign, $yAlign)->save();

        $user = Auth::user();
        $user->avatar = asset($photo);
        $user->save();

        return redirect('user/avatar');
    }
}
