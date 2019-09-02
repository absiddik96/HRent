<?php

namespace App\Http\Controllers\Api\V1\Admin\Location;

use App\Models\Location\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => City::orderBy('city')->get()]);
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
            'city' => 'required|string|unique:cities,city',
        ]);

        $request['country_id'] = $request->country;
        $request['division_id'] = $request->division;

        if (City::create($request->all())) {
            return response()->json(['success' => 'City added successfully']);
        } else {
            return response()->json(['error' => 'Failed to add City']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return response()->json(['data' => $city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $this->validate($request, [
            'country' => 'required|numeric',
            'division' => 'required|numeric',
            'city' => 'required|string|unique:cities,city,'.$city->id,
        ]);

        $request['country_id'] = $request->country;
        $request['division_id'] = $request->division;

        if ($city->update($request->all())) {
            return response()->json(['success' => 'City updated successfully']);
        } else {
            return response()->json(['error' => 'Failed to update City']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        if ($city->delete()) {
            return response()->json(['success' => 'City deleted successfully']);
        } else {
            return response()->json(['error' => 'Failed to delete City']);
        }
    }
}
