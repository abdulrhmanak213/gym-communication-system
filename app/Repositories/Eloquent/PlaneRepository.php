<?php

namespace App\Repositories\Eloquent;

use App\Models\Plane;
use App\Repositories\Contracts\IBase;
use App\Repositories\Contracts\IPlane;

class PlaneRepository extends BaseRepository implements IPlane
{
    public function model(): string
    {
        return Plane::class;
    }
    public function syncingManyToManyRelationPD($plane_id, $day_id)
    {
        $plane = $this->model->find($plane_id);
        $plane->days()->syncWithoutDetaching($day_id);
    }

    public function detachingManyToManyRelationPD($plane_id,$day_id)
    {
        $plane = $this->model->find($plane_id);
        $plane->days()->detach($day_id);
    }
}
