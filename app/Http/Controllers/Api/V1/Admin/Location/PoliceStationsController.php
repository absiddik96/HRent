<?php

namespace App\Http\Controllers\Api\V1\Admin\Location;

use App\Models\Location\PoliceStation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PoliceStationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => PoliceStation::orderBy('police_station')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'country' => 'required|numeric',
            'division' => 'required|numeric',
            'city' => 'required|numeric',
            'police_station' => 'required|string|unique:police_stations,police_station',
        ]);

        $request['country_id'] = $request->country;
        $request['division_id'] = $request->division;
        $request['city_id'] = $request->city;

        if (PoliceStation::create($request->all())) {
            return response()->json(['success' => 'Police Station added successfully']);
        } else {
            return response()->json(['error' => 'Failed to add Police Station']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location\PoliceStation  $policeStation
     * @return \Illuminate\Http\Response
     */
    public function show(PoliceStation $policeStation)
    {
        return response()->json(['data' => $policeStation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location\PoliceStation  $policeStation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PoliceStation $policeStation)
    {
        $this->validate($request, [
            'country' => 'required|numeric',
            'division' => 'required|numeric',
            'city' => 'required|numeric',
            'police_station' => 'required|string|unique:police_stations,police_station,'.$policeStation->id,
        ]);

        $request['country_id'] = $request->country;
        $request['division_id'] = $request->division;
        $request['city_id'] = $request->city;

        if ($policeStation->update($request->all())) {
            return response()->json(['success' => 'Police Station updated successfully']);
        } else {
            return response()->json(['error' => 'Failed to update Police Station']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location\PoliceStation  $policeStation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PoliceStation $policeStation)
    {
        if ($policeStation->delete()) {
            return response()->json(['success' => 'Police Station deleted successfully']);
        } else {
            return response()->json(['error' => 'Failed to delete Police Station']);
        }
    }
}
