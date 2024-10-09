<?php

use App\Channels\MailChannel;
use App\Channels\SMSChannel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Notification;
use Services\Mail\MailService;
use Services\Mail\MockMail\MockMailService;
use Services\SMS\MockSMS\MockSMSService;
use Services\SMS\SMSService;

return Application::configure(basePath: dirname(__DIR__))
    ->withBindings([
        SMSService::class => MockSMSService::class,
        MailService::class => MockMailService::class,
    ])
    ->booted(function (Application $application) {
        Notification::extend('sms-fake', function ($app) use($application){
            return new SMSChannel($application->make(SMSService::class));
        });
        Notification::extend('mail-fake', function ($app) use($application){
            return new MailChannel($application->make(MailService::class));
        });
    })
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
