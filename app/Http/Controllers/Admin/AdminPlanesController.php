<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminPlaneRequest;
use App\Http\Resources\Plane\PlaneResource;
use App\Repositories\Contracts\IAdmin;
use App\Repositories\Contracts\IDay;
use App\Repositories\Contracts\IPlane;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;

class AdminPlanesController extends Controller
{
    use HttpResponse;
    protected $admin, $plane, $day;
    public function __construct(IAdmin $admin , IPlane $plane , IDay $day){
        $this->admin = $admin;
        $this->plane = $plane;
        $this->day = $day;
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

    public function getAll(): \Illuminate\Http\Response
    {
        return self::returnData('planes',PlaneResource::collection($this->plane->all()),'success',200);
    }

    public function get($id): \Illuminate\Http\Response
    {
        return self::returnData('planes',new PlaneResource($this->plane->find($id)),'success',200);
    }

    public function delete($id): \Illuminate\Http\Response
    {
        $plane = $this->plane->find($id);
        $this->plane->delete($plane->id);
        return self::success('plane deleted successfully',200);
    }


    public function updateStatus(Request $request,$id): \Illuminate\Http\Response
    {
        $data = $request->input('status');
        $plane = $this->plane->find($id);
        $this->plane->forceFill(['status'=>$data],$plane->id);
        return self::success('plane updated successfully',200);
    }

    public function updateSecurity(Request $request,$id): \Illuminate\Http\Response
    {
        $data = $request->input('security');
        $plane = $this->plane->find($id);
        $this->plane->forceFill(['security'=>$data],$plane->id);
        return self::success('plane updated successfully',200);
    }
}
