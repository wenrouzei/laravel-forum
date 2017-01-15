<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function verify(Request $request, $confirm_token)
    {
        $user = User::where('confirm_token', $confirm_token)->first();
        if(is_null($user)){
            return redirect('/');
        }

        $user->is_confirmed = 1;
        $user->confirm_token = str_random(48);
        $user->save();

        return redirect('login');
    }
}
