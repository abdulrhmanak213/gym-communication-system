<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Contracts\IAdmin;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLogInController extends Controller
{
    use HttpResponse;
    protected $admin;
    public function __construct(IAdmin $admin){
        $this->admin = $admin;
    }

    public function login (LoginRequest $request): \Illuminate\Http\Response
    {
        $token = Auth::guard('admin')->attempt($request->all());
        if (!$token) {
            return self::failure("wrong password or email, please check your inputs again", 403);
        }
        $user = Auth::guard('admin')->user();
        $user['token'] = $token;
        return self::returnData('admin',$user,'success',200);
    }
}
