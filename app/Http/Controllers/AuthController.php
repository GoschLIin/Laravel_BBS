<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login.login_form');
    }

    public function login(LoginFormRequest $request)
    {
        $credentials = $request->only('login_id','password');
        $login_check = $request['login_id'];
        //dd($login_check);
        if(Auth::attempt($credentials)){
           $request->session()->regenerate();
           
           if($login_check=="admin"){
            return redirect()->route('account_index')->with('login_success',$login_check);
           }else
           return redirect()->route('bbs_top')->with('login_success',$login_check);
        }

       return back()->withErrors([
        'login_error' => 'ログインIDかパスワードが間違っています。',
    ]);
    }


    /**
     * ユーザーをアプリケーションからログアウトさせる
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.show')->with('logout','ログアウトしました！');
    }
}