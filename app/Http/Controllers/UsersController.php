<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['only'=>['login', 'signin']]);
        $this->middleware('auth', ['only'=>['avatar', 'avatarUpload']]);
    }

    public function register(){
        return view('users.register');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegisterRequest $request)
    {
        $data = [
            'confirm_code' => str_random(48),
            'avatar'=>'/images/default_avatar.png'
        ];

        $user = User::create(array_merge($request->all(),$data));
        $subject = 'Confirm Your Email';
        $view = 'email.register';
        $this->sendTo($user, $subject, $view, $data);
        return redirect('/');
    }

    public function confirmEmail($confirm_code)
    {
        $user = User::where('confirm_code', $confirm_code)->first();
        if(is_null($user)){
            return redirect('/');
        }

        $user->is_confirmed = 1;
        $user->confirm_code = str_random(48);
        $user->save();

        return redirect('user/login');
    }

    public function login()
    {
        return view('users.login');
    }

    public function signin(UserLoginRequest $request)
    {
        if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'is_confirmed' => 1
        ])){
            return redirect('/');
        }

        Session::flash('user_login_failed', '密码不正确或邮箱没验证');
        return redirect()->back()->withInput();
    }

    public function avatar()
    {
        return view('users.avatar');
    }

    public function avatarUpload(Request $request)
    {
        $file = $request->file('avatar');

        $destinationPath = 'uploads/';
        $filename = Auth::user()->id.'_'.time().'_'.$file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);

        $user = User::find(Auth::user()->id);
        $user->avatar = '/'.$destinationPath.$filename;
        $user->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function sendTo($user, $subject, $view, $data)
    {
        Mail::queue($view, $data, function ($message) use ($user, $subject){
            $message->to($user->email)->subject($subject);
        });
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
