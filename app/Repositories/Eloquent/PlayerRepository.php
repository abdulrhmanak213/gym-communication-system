<?php

namespace App\Repositories\Eloquent;

use App\Models\Player;
use App\Models\Coach;
use App\Repositories\Contracts\IPlayer;
use Carbon\Carbon;

class PlayerRepository extends BaseRepository implements IPlayer
{

    public function model(): string
    {
        return Player::class;
    }

    public function getAge($player): int
    {
        $player = $this->find($player->id);
        return  Carbon::parse($player->birth_date)->age;
    }

    public function syncingManyToManyRelationPP($player_id,$plane_id)
    {
        $player = $this->model->find($player_id);
        $player->planes()->syncWithoutDetaching($plane_id);
    }

    public function detachingManyToManyRelationPP($player_id,$plane_id)
    {
        $player = $this->model->find($player_id);
        $player->days()->detach($plane_id);
    }
}

