<?php

namespace App\Http\Controllers\Api\V1\Admin\Location;

use App\Models\Location\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DivisionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => Division::orderBy('division')->get()]);
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
            'division' => 'required|string|unique:divisions,division',
        ]);

        $request['country_id'] = $request->country;

        if (Division::create($request->all())) {
            return response()->json(['success' => 'Division added successfully']);
        } else {
            return response()->json(['error' => 'Failed to add Division']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {
        return response()->json(['data' => $division]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Division $division)
    {
        $this->validate($request, [
            'country' => 'required|numeric',
            'division' => 'required|string|unique:divisions,division,'.$division->id,
        ]);

        $request['country_id'] = $request->country;

        if ($division->update($request->all())) {
            return response()->json(['success' => 'Division updated successfully']);
        } else {
            return response()->json(['error' => 'Failed to update Division']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy(Division $division)
    {
        if ($division->delete()) {
            return response()->json(['success' => 'Division deleted successfully']);
        } else {
            return response()->json(['error' => 'Failed to delete Division']);
        }
    }
}
