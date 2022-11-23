<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Player\ProfileResource;
use App\Repositories\Contracts\IPlayer;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;

class AdminPlayerController extends Controller
{
    use HttpResponse;
    protected $player;
    public function __construct(IPlayer $player){
        $this->player = $player;
    }

    public function getAll(): \Illuminate\Http\Response
    {
        return self::returnData('players',ProfileResource::collection($this->player->all()),'success',200);
    }

    public function get($id): \Illuminate\Http\Response
    {
        return self::returnData('player',new ProfileResource($this->player->find($id)),'success',200);
    }

    public function delete($id): \Illuminate\Http\Response
    {
        $player = $this->player->find($id);
        $this->player->delete($player->id);
        return self::success('player deleted successfully',200);
    }
}
