<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Http\Resources\Player\ProfileResource;
use App\Repositories\Contracts\ICoach;
use App\Repositories\Contracts\IPlayer;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;

class PlayersController extends Controller
{
    use HttpResponse;
    protected $player,$coach;
    public function __construct(IPlayer $player, ICoach $coach){
        $this->player = $player;
        $this->coach =  $coach;
    }
    public function getMyPlayers(): \Illuminate\Http\Response
    {
        $coach = $this->coach->find(auth()->user()->id);
        return self::returnData('players',ProfileResource::collection($coach->players()->get()),'success',200);
    }
}
