<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'days';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];

    public function planes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Plane::class);
    }

}
