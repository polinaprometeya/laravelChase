<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    //this class is in no way tied to Event model or controller and therefore we would need to write those classes explicitly
    public function toArray(Request $request): array
    {
        return
        [
        'id' => $this->id,
        'name' => $this->name,
        'description' => $this->description,
        'start_time' => $this->start_time,
        'end_time' => $this->end_time,
        'user' => new UserResource($this->whenLoaded('user')),
        'attendees' => AttendeeResource::collection(
            $this->whenLoaded('attendees')
        )
        ];
        //return parent::toArray($request);
    }
}
