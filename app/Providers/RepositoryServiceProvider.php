<?php

namespace App\Providers;

use App\Contracts\BookingRepositoryInterface;
use App\Contracts\TableRepositoryInterface;
use App\Repositories\EloquentBookingRepository;
use App\Repositories\EloquentTableRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BookingRepositoryInterface::class, EloquentBookingRepository::class);
        $this->app->bind(TableRepositoryInterface::class, EloquentTableRepository::class);
    }

    public function boot()
    {
        //
    }
}
