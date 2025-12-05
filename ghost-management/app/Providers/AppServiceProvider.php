<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Attendee;
use App\Policies\EventPolicy;
use App\Policies\AttendeePolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    //this is a way to register policies for models
    //BUT it is not recommended to use it, because it is not flexible enough
    //it is better to use the authorizeResource method in the controller
    //but if you need to use it, you can do it here
    //Laravel is smart enough to know which policy to use based on the model and the action
    // protected $policies = [
    //     Event::class => EventPolicy::class,
    //     Attendee::class => AttendeePolicy::class,
    // ];

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
    //Good for application wide global authentication
    public function boot(): void
    {
        //rate limiter is for protection against abuse
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        }); //max 60 request in 1 minute - rate limiter

        // RateLimiter::for('reviews', function (Request $request) {
        //     return Limit::perHour(3)->by(optional($request->user())->id ?: $request->ip());
        // });

        //due to policy this is technically redundant, it makes more sense to have authentication for not model specific actions here
        //Gate::authorize('update', function ($user, Event $event) { return $user->id === $event->user_id;});
        // Gate::define('update-event', function ($user, Event $event) {  return $user->id === $event->user_id;  });
        // Gate::define('delete-attendee', function ($user, Event $event, Attendee $attendee) { return $user->id === $event->user_id || $user->id === $attendee->user_id;});
    }
}
