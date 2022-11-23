<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Http\Requests\Coach\ProfileUpdateRequest;
use App\Http\Resources\Coach\ProfileResource;
use App\Repositories\Contracts\ICoach;
use App\Traits\HandleImage;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;

class CoachProfileController extends Controller
{
    use HttpResponse,HandleImage;
    protected $coach;
    public function __construct(ICoach $coach){
    $this->coach = $coach;
    }
    public function profile(): \Illuminate\Http\Response
    {
        $coach = $this->coach->find(auth()->user()->id);
        return self::returnData('profile',new ProfileResource($coach),'success',200);
    }

    public function update(ProfileUpdateRequest $request): \Illuminate\Http\Response
    {
        $data = $request->all();
        if($data==null){
            return self::failure('check your data',400);
        }
        if(array_key_exists('picture',$data)){
            $data['picture'] = self::handle($data['picture']);
        }
        $coach = $this->coach->find(auth()->user()->id);
        $this->coach->forceFill($data,$coach->id);
        return self::success('profile updated successfully',200 );
    }

    public function getCoach($id): \Illuminate\Http\Response
    {
    return self::returnData('coach',new ProfileResource($this->coach->find($id)),'success',200);
    }

    public function getAll(): \Illuminate\Http\Response
    {
        return self::returnData('coaches',ProfileResource::collection($this->coach->all()),'success',200);
    }
}
