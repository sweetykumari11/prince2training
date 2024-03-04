<?php

namespace App\Providers;
use App\Models\Tag;
use App\Models\Blog;
use App\Models\Country;
use App\Models\BlogDetail;

use App\Models\PageContent;
use App\Observers\TagObserver;
use App\Observers\BlogObserver;
use App\Observers\CountryObserver;
use App\Observers\BlogdetailObserver;
use Illuminate\Support\Facades\Event;
use App\Observers\PagecontentObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


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
        Blog::observe(BlogObserver::class);
        BlogDetail::observe(BlogdetailObserver::class);
        Tag::observe(TagObserver::class);
        country::observe(CountryObserver::class);
        PageContent::observe(PagecontentObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
