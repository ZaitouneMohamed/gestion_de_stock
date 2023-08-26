<?php

namespace App\Providers;

use App\Events\CreateEntree;
use App\Events\CreateSortieEvent;
use App\Listeners\CreateEntreeListener;
use App\Listeners\CreateSortieListener;
use App\Listeners\UpdateQteAndHistory;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CreateEntree::class => [
            CreateEntreeListener::class,
        ],
        CreateSortieEvent::class => [
            CreateSortieListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
