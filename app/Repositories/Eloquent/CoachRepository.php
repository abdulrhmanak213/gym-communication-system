<?php

namespace App\Repositories\Eloquent;

use App\Models\Coach;
use App\Repositories\Contracts\ICoach;

class CoachRepository extends BaseRepository implements ICoach
{
    public function model(): string
    {
        return Coach::class;
    }
}
