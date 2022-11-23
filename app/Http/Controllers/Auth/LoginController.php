<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoggedInCoachResource;
use App\Http\Resources\Auth\LoggedInPlayerResource;
use App\Repositories\Contracts\ICoach;
use App\Repositories\Contracts\IPlayer;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use HttpResponse;
    protected $player,$coach;
    public function __construct(IPlayer $player, ICoach $coach){
        $this->player = $player;
        $this->coach = $coach;
    }

    public function login(LoginRequest $request, $type): \Illuminate\Http\Response
    {
        $token = Auth::guard($type)->attempt($request->all());
        if (!$token) {
            return self::failure("wrong password or email, please check your inputs again", 403);
        }
        $user = Auth::guard($type)->user();
        $user['token'] = $token;
        return self::returnData('user', $type=='player'?new LoggedInPlayerResource($user):new LoggedInCoachResource($user),'logged in successfully',200);
    }
}
