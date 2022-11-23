<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Coach extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $table = 'coaches';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];


    //////////////////////////////// relations /////////////////////////////////
    public function players(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Player::class);
    }
    /////////////////////////////// JWT Functions //////////////////////////////
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
