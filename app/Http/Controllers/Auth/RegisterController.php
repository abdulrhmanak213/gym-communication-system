<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\coachRegisterRequest;
use App\Http\Requests\Auth\playerRegisterRequest;
use App\Http\Resources\Auth\coachRegisterResource;
use App\Repositories\Contracts\ICoach;
use App\Repositories\Contracts\IPlayer;
use App\Traits\HandleImage;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use HttpResponse,HandleImage;
    protected $player,$coach;
    public function __construct(ICoach $coach, IPlayer $player){
        $this->coach = $coach;
        $this->player = $player;
    }
    public function coachRegister(coachRegisterRequest $request): \Illuminate\Http\Response
    {
    $data =  array_merge($request->all(), ['password' => bcrypt($request->password)]);
    unset($data['password_confirmation']);
    $data['picture'] = self::handle($data['picture']);
    $this->coach->create($data);
    return self::success('user created successfully', 201);
    }

    public function playerRegister(playerRegisterRequest $request): \Illuminate\Http\Response
    {
        $data =  array_merge($request->all(), ['password' => bcrypt($request->password)]);
        unset($data['password_confirmation']);
        $data['picture'] = self::handle($data['picture']);
        $this->player->create($data);
        return self::success('user created successfully', 201);
    }


}
