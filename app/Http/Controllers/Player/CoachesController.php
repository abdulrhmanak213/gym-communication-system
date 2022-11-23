<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICoach;
use App\Repositories\Contracts\IPlayer;
use App\Traits\HandleImage;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;

class CoachesController extends Controller
{
    use HttpResponse;
    protected $player,$coach;
    public function __construct(IPlayer $player, ICoach $coach){
        $this->player = $player;
        $this->coach =  $coach;
    }

    public function selectCoach($coach_id): \Illuminate\Http\Response
    {
        $player = $this->player->find(auth()->user()->id);
        $coach = $this->coach->find($coach_id);
        $this->player->forceFill(['coach_id'=>$coach->id],$player->id);
        return self::success('coach selected successfully',200);
    }
}
