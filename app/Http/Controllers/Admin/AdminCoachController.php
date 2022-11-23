<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Coach\ProfileResource;
use App\Repositories\Contracts\ICoach;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;

class AdminCoachController extends Controller
{
    use HttpResponse;
    protected $coach;
    public function __construct(ICoach $coach){
        $this->coach = $coach;
    }

    public function getAll(): \Illuminate\Http\Response
    {
        return self::returnData('coaches',ProfileResource::collection($this->coach->all()),'success',200);
    }

    public function get($id): \Illuminate\Http\Response
    {
        return self::returnData('coach',new ProfileResource($this->coach->find($id)),'success',200);
    }

    public function delete($id): \Illuminate\Http\Response
    {
        $coach = $this->coach->find($id);
        $this->coach->delete($coach->id);
        return self::success('coach deleted successfully',200);
    }
}
