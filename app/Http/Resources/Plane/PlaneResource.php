<?php

namespace App\Http\Resources\Plane;

use App\Http\Resources\DayResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
            'name'=>$this->name,
            'statues'=>$this->status,
            'security'=>$this->security,
            'days'=>DayResource::collection($this->days),
            ];
    }
}
