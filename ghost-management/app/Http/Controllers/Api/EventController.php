<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Event::query();
        $relations = ['user', 'attendees', 'attendees.user']; //this controls what can be loaded and what cannot

        foreach ($relations as $relation) {
            $query -> when(
                $this->shouldIncludeRelation($relation),
                fn ($option) => $option->with($relation)
            );
        }
        $this->shouldIncludeRelation('user');
        //events collection -- > which means an array was wrapped like this -> {"data":[ my array stuff here {},{}..]}
        //$events = EventResource::collection(Event::all());
        $events = EventResource::collection(
            $query->latest()->paginate()
        );
        return $events;
    }

    protected function shouldIncludeRelation(string $relation): bool
    {
        $include = request()->query('include');
        if (!$include) {
            return false;
        }

        $relations = array_map('trim', explode(',', $include));
        //dd($relations);
        //return $relations;

        return in_array($relation, $relations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = 1;
        $event = new EventResource(Event::create($data));
        return $event;
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load('user', 'attendees');
        //EventResource -- wrapper decides how things are serialized
        //and therefore can help make sure some values are not returned in certain cases
        //or data type of returned property is different in certain cases
        //it can also be used to sterilize data so it looks different then in Eloquent model and hide data
        $event = new EventResource($event);
        return $event;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        $data = $request->validated();

        $event->update($data);

        $event = new EventResource($event);
        return $event;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        // return redirect()->route('api/events');
        // return response()->json(['The event is deleted successfully']);
        return response()->json(status: 204);
    }
}
