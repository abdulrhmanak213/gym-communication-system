<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Http\Requests\Player\ProfileUpdateRequest;
use App\Http\Resources\Player\ProfileResource;
use App\Repositories\Contracts\IPlayer;
use App\Traits\HandleImage;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;

class PlayerProfileController extends Controller
{
    use HttpResponse,HandleImage;
    protected $player;
    public function __construct(IPlayer $player){
       $this->player = $player;
    }
    public function profile()// \Illuminate\Http\Response
    {
        $player = $this->player->find(auth()->user()->id);
        return self::returnData('profile',new ProfileResource($player),'success',200);
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
        $player = $this->player->find(auth()->user()->id);
        $this->player->forceFill($data,$player->id);
        return self::success('profile updated successfully',200 );
    }

}
