<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('activities', [
            'activities' => auth()->user()->activities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->back()->with('addActivity', true);
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActivityRequest $request)
    {
        $data = $request->validated();
        $data['created_at'] = now();
        $data['updated_at'] = now();
        Activity::create($data);
        return redirect()->back()->with('message', 'Activity created successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        return redirect()->back()->with('editActivityId', $activity->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $data = $request->validated();
        $data['updated_at'] = now();
        $activity->update($data);
        return redirect()->back()->with('message', 'Activity updated successfully')->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->back()->with('message', 'Activity deleted successfully')->with('type', 'success');
    }
}
