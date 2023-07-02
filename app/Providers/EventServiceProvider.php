<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\GarbageType;
use App\Models\ServiceGarbage;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\ContainerGarbageType;
use App\Observers\ContainerGarbageObserver;
use App\Models\Service;
use App\Observers\ServiceObserver;
use App\Observers\GarbageTypeIconObserver;
use App\Observers\ServiceGarbageSlugObserver;
use App\Observers\PageSlugObserver;
use App\Models\Page;
use App\Observers\MyObserver;
use App\Observers\MyServiceObserver;
use App\Observers\CategoryIconObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // ContainerGarbageType::observe(ContainerGarbageObserver::class);
        // Service::observe(ServiceObserver::class);
        GarbageType::observe(GarbageTypeIconObserver::class);
        ServiceGarbage::observe(ServiceGarbageSlugObserver::class);
        Page::observe(PageSlugObserver::class);
        ContainerGarbageType::observe(MyObserver::class);
        Service::observe(MyServiceObserver::class);
        Category::observe(CategoryIconObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
