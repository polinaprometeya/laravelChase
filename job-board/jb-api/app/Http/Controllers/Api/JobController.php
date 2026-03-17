<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Traits\CanLoadRelationships;

class JobController extends Controller
{
    // use CanLoadRelationships;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $query = Job::query();
        // foreach ($relations as $relation) {
        //     $query -> when(
        //         $this->shouldIncludeRelation($relation),
        //         fn ($option) => $option->with($relation)
        //     );
        // }

        //$this->shouldIncludeRelation('user');
        //events collection -- > which means an array was wrapped like this -> {"data":[ my array stuff here {},{}..]}
        //$events = EventResource::collection(Event::all());

        // $jobs = JobResource::collection(
        //     $query->latest()->paginate()
        // );

        return $query;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}
