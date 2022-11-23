<?php

namespace App\Http\Controllers\Plane;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminPlaneRequest;
use App\Http\Resources\Plane\PlaneResource;
use App\Repositories\Contracts\IDay;
use App\Repositories\Contracts\IPlane;
use App\Repositories\Contracts\IPlayer;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;

class PlaneController extends Controller
{
    use HttpResponse;
    protected $plane, $day, $player;
    public function __construct(IPlane $plane, IDay $day, IPlayer $player){
        $this->plane = $plane;
        $this->day = $day;
        $this->player = $player;
    }

    public function getAll(): \Illuminate\Http\Response
    {
        return self::returnData('planes',PlaneResource::collection($this->plane->findWhere('security','public')),'success',200);
    }

    public function get($id): \Illuminate\Http\Response
    {
        return self::returnData('plane', new PlaneResource($this->plane->find($id)),'success',200);
    }

    public function create(AdminPlaneRequest $request): \Illuminate\Http\Response
    {
        $data = $request->all();
        $days = $data['days'];
        unset($data['days']);
        $plane = $this->plane->create($data);
        foreach ($days as $day){
            $day = $this->day->findWhere('name',$day);
            $this->plane->syncingManyToManyRelationPD($plane->id,$day->first()->id);
        }
        return self::success('plane created successfully',200);
    }

    public function updateStatus(Request $request,$id): \Illuminate\Http\Response
    {
        $data = $request->input('status');
        $plane = $this->plane->find($id);
        $this->plane->forceFill(['status'=>$data],$plane->id);
        return self::success('plane updated successfully',200);
    }

    public function selectPlane($plane_id): \Illuminate\Http\Response
    {
        $plane = $this->plane->find($plane_id);
        $player = $this->player->find(auth()->user()->id);
        $this->player->syncingManyToManyRelationPP($player->id,$plane->id);
        return self::success('plane added to your planes successfully',200);
    }
}
