<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class LoggedInCoachResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'picture'=>$this->picture,
            'description'=>$this->description,
            'token'=>$this->token,

        ];
    }
}
