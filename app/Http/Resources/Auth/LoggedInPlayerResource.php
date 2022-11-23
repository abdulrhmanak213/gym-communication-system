<?php

namespace App\Http\Resources\Auth;

use App\Repositories\Eloquent\PlayerRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class LoggedInPlayerResource extends JsonResource
{

    public function toArray($request)
    {
        $player = new PlayerRepository();
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'picture'=>$this->picture,
            'age'=>$player->getAge($this),
            'gender'=>$this->gender,
            'weight'=>$this->weight,
            'token'=>$this->token,
        ];
    }
}
