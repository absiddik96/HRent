<?php

namespace App\Http\Controllers\Api\V1\Admin\Location;

use App\Models\Location\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => Country::orderBy('country')->get()]);
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
            'country' => 'required|string|unique:countries,country'
        ]);

        if (Country::create($request->all())) {
            return response()->json(['success' => 'Country added successfully']);
        } else {
            return response()->json(['error' => 'Failed to add Country']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return response()->json(['data' => $country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $this->validate($request, [
            'country' => 'required|string|unique:countries,country,'.$country->id
        ]);

        if ($country->update($request->all())) {
            return response()->json(['success' => 'Country updated successfully']);
        } else {
            return response()->json(['error' => 'Failed to update Country']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        if ($country->delete()) {
            return response()->json(['success' => 'Country deleted successfully']);
        } else {
            return response()->json(['error' => 'Failed to delete Country']);
        }
    }
}
