<?php

namespace App\Traits;

trait HttpResponse
{
    public function success($message,$status):\Illuminate\Http\Response
    {
        return response([
            'success'=>true,
            'message'=>$message,
        ],$status);
    }

    public function failure($message,$status):\Illuminate\Http\Response
    {
        return response([
            'success'=>false,
            'message'=>$message
        ],$status);
    }

    public function returnData($kay,$value,$message,$statue):\Illuminate\Http\Response
    {
        return response([
           'success'=>true,
           'message'=>$message,
            $kay=>$value,
        ],$statue);
    }



}
