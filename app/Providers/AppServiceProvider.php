<?php

namespace App\Providers;

use App\Channels\SMSChannel;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;
use Services\SMS\MockSMS\MockSMSService;
use Services\SMS\SMSService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
