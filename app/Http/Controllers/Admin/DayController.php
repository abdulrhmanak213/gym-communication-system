<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DayRequest;
use App\Repositories\Contracts\IDay;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use function Symfony\Component\String\s;

class DayController extends Controller
{
    use HttpResponse;
    protected $day;
    public function __construct(IDay $day){
        $this->day = $day;
    }
    public function  create(DayRequest $request): \Illuminate\Http\Response
    {
        $data = $request->all();
        $this->day->create($data);
        return self::success('created successfully',201);
    }

    public function gatAll(): \Illuminate\Http\Response
    {
        return self::returnData('days',$this->day->all(),'success',200);
    }

}
