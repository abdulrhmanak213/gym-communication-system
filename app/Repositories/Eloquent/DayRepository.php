<?php

namespace App\Repositories\Eloquent;

use App\Models\Day;
use App\Repositories\Contracts\IDay;

class DayRepository extends BaseRepository implements IDay
{
    public function model(): string
    {
        return Day::class;
    }
}
