<?php

namespace App\Providers;


use App\Repositories\Contracts\IAdmin;
use App\Repositories\Contracts\ICoach;
use App\Repositories\Contracts\IDay;
use App\Repositories\Contracts\IPlane;
use App\Repositories\Contracts\IPlayer;
use App\Repositories\Eloquent\AdminRepository;
use App\Repositories\Eloquent\CoachRepository;
use App\Repositories\Eloquent\DayRepository;
use App\Repositories\Eloquent\PlaneRepository;
use App\Repositories\Eloquent\PlayerRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ICoach::class, CoachRepository::class);
        $this->app->bind(IPlayer::class, PlayerRepository::class);
        $this->app->bind(IDay::class, DayRepository::class);
        $this->app->bind(IPlane::class, PlaneRepository::class);
        $this->app->bind(IAdmin::class, AdminRepository::class);
    }

    public function boot()
    {
        //
    }
}
