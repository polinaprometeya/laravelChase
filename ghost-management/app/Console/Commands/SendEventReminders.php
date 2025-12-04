<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\Event;

class SendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Custom command that sends notifications to all event attendees';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //this is a collection - so events will be an array
        $events = Event::with('attendees.user')
        ->whereBetween('start_time', [now(), now()->addDay()])
        ->get();

        $eventCount = $events->count();
        $eventLabel = Str::plural('event', $eventCount);

        $this->info("Found {$eventCount} {$eventLabel}");

        //this is closer that runs on every event in this collection
        $events -> each(fn ($event) => $event->attendees->each(
            fn ($attendee) => $this->info("Notifying the user {$attendee->user->id}")
        ));

        $this->info('Reminder notifications where sent successfully');
    }
}
