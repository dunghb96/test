<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
class UserController extends Controller
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(){
        if (Auth::guard('admin')->user()->auth != User::MANAGER_USER) {
            return abort(404);
        }
        $users = $this->user->getAll();
        return view('admin.user.index',compact('users'));
    }
    public function create()
    {
        return view('admin.user.create');
    }
    public function store(UserRequest $request)
    {
        $this->user->create([
            'name'=> $request->name,
            'email' => $request -> email,
            'pass' => Hash::make($request->password),
            'auth' => $request->auth
        ]);
        return redirect()->route('admin.user.index')->with('success', 'ユーザー情報登録が完了しました。');
    }
    public function edit($id)
    {
        $user = $this->user->find($id);
        return view('admin.user.edit', compact('user'));
    }
    public function update(UserRequest $request, $id)
    {
        $this->user->find($id)->update([
            "name"=> $request ->name,
            "email" => $request ->email,
            'pass' =>Hash::make($request->password),
            'auth' => $request->auth
        ]);
        return redirect()->route('admin.user.index')->with('success', 'ユーザー情報編集が完了しました。');
    }
    public function delete( Request $request)
    {
        try{
            $loginUser = Auth::guard('admin')->user();
            $ids = $request->input('id');

            if ($loginUser->auth == User::MANAGER_USER) {
                if (is_array($ids)) {
                    foreach ($ids as $id) {
                        if (!$loginUser->id == $id) {
                            $this->user->find($id)->delete();
                            return response()->json([
                                'code'=>200,
                                'message'=>'success'
                            ],200);
                        }
                    }
                } else {
                    if ($loginUser->id == $ids) {
                        return response()->json([
                            'code'=>400,
                            'message'=>'error'
                        ],400);
                    }else {
                        $this->user->find($ids)->delete();
                        return response()->json([
                            'code'=>200,
                            'message'=>'success'
                        ],200);
                    }
                }
            }
            return response()->json([
                'code'=>400,
                'message'=>'error'
            ],400);

        }catch (\Exception $exception){
            Log::error('message:' . $exception->getMessage(). '----Line: ' . $exception->getMessage());
            return response()->json([
                'code'=>500,
                'message'=>'fail'
            ], 500);
        }
    }

}
