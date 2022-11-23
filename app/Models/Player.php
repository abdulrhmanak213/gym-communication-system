<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Player extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $table = 'players';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];
    public $with = ['planes'];

    //////////////////////////////// relations /////////////////////////////////
    public function coaches():\Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Coach::class);
    }
    public function planes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Plane::class);
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
