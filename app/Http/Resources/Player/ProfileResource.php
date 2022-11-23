<?php

namespace App\Http\Resources\Player;

use App\Http\Resources\Plane\PlaneResource;
use App\Repositories\Eloquent\PlayerRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{

    public function toArray($request)
    {
        $player = new PlayerRepository();
        return [
            'name'=>$this->name,
            'picture'=>$this->picture,
            'age'=>$player->getAge($this),
            'gender'=>$this->gender,
            'weight'=>$this->weight,
            'coach_id'=>$this->coach_id,
            'my_planes'=> PlaneResource::collection($this->planes),
        ];
    }
}
