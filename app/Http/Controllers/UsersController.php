<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPasswordEditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('users.index');
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

    /**
     * 用户修改密码视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function password()
    {
        return view('users.password');
    }

    /**
     * 用户修改密码
     * @param UserPasswordEditRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function passwordEdit(UserPasswordEditRequest $request)
    {
        $user = Auth::user();
        $old_password = $request->input('old_password');
        $new_password = $request->input('password');

        if(!Hash::check($old_password, $user->password)){
            flash('当前密码输入错误，请重新输入');
            return redirect()->back();
        }elseif(Hash::check($new_password,$user->password)){
            flash('输入的新密码跟当前密码相同，无需修改');
            return redirect()->back();
        }

        $user->password = bcrypt($new_password);
        $user->save();

        Auth::logout();

        $request->session()->flush();

        $request->session()->regenerate();

        flash('密码修改成功，请用新密码重新登录', 'success');

        return redirect('/login');
    }
}
