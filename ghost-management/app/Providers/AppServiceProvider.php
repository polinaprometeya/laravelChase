<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // RateLimiter::for('reviews', function (Request $request) {
        //     return Limit::perHour(3)->by(optional($request->user())->id ?: $request->ip());
        // });

        //Gate::authorize('update', function ($user, Event $event) { return $user->id === $event->user_id;});

        Gate::define('update-event', function ($user, Event $event) {  return $user->id === $event->user_id;  });

        Gate::define('delete-attendee', function ($user, Event $event, Attendee $attendee) { return $user->id === $event->user_id || $user->id === $attendee->user_id;});
    }
}
