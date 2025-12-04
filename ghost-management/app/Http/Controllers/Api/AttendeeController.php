<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendeeRequest;
use App\Http\Resources\AttendeeResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\Attendee;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User as UserModel;

class AttendeeController extends Controller
{
    use CanLoadRelationships;

    private array $relations = ['user'];

    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        $query = $this->loadRelationships(
            $event->attendees()->latest()
        );
        
        $attendees = AttendeeResource::collection(
            $query->paginate()
        );
        
        return $attendees;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        // $data = $event->attendees()->create(['user_id' => 1]);
        // $attendee = new AttendeeResource($data);

        $data = $this->loadRelationships(
            $event->attendees()->create([
                'user_id' => 1
            ])
        );
        $attendee = new AttendeeResource($data);
        return $attendee;
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, Attendee $attendee)
    {
        // return new AttendeeResource($attendee);
        $attendee = new AttendeeResource($this->loadRelationships($attendee));
        return $attendee;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event, Attendee $attendee)
    {
        $attendee->delete();
        return response(status: 204);
    }
}
