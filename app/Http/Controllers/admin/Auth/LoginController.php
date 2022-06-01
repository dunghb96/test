<?php

namespace App\Http\Controllers\admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function getLoginAdmin()
    {
        return view('admin.auth.login');
    }
    public function PostLogin(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ],
            [
                'email.required' => 'メールアドレスを入力してください。',
                'email.email' => 'メールアドレス形式で指定してください。',
                'password.required' => 'パスワードを入力してください。',
                'password.min' => '6文字以上入力してください。'
            ]
        );

        $user = User::where('email', $request->email)->first();

        if (is_null($user) || !Hash::check( $request->password, $user->pass)) {
            return redirect()->back()->with('msg', 'アカウントまたはパスワードが間違っています。');
        }

        Auth::guard('admin')->login($user);
        return redirect(route('admin.home'));
    }
}
