<?php

namespace App\Http\Controllers\Api\V1\Admin\Location;

use App\Http\Controllers\Controller;
use App\Models\Location\Village;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class VillagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(['data' => Village::orderBy('village')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'country' => 'required|numeric',
            'division' => 'required|numeric',
            'city' => 'required|numeric',
            'police_station' => 'required|numeric',
            'word' => 'required|numeric',
            'village' =>
                [
                    'required',
                    'string',
                    Rule::unique('villages')->where(function ($query) use ($request) {
                        return $query->where('police_station_id', $request->police_station)
                            ->where('word_id', $request->word)
                            ->where('village', $request->village);
                    }),
                ],
        ]);

        $request['country_id'] = $request->country;
        $request['division_id'] = $request->division;
        $request['city_id'] = $request->city;
        $request['police_station_id'] = $request->police_station;
        $request['word_id'] = $request->word;

        if (Village::create($request->all())) {
            return response()->json(['success' => 'Village added successfully']);
        } else {
            return response()->json(['error' => 'Failed to add Village']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Village $village
     * @return Response
     */
    public function show(Village $village)
    {
        return response()->json(['data' => $village]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Village $village
     * @return Response
     */
    public function update(Request $request, Village $village)
    {
        $this->validate($request, [
            'country' => 'required|numeric',
            'division' => 'required|numeric',
            'city' => 'required|numeric',
            'police_station' => 'required|numeric',
            'word' => 'required|numeric',
            'village' =>
                [
                    'required',
                    'string',
                    Rule::unique('villages')->where(function ($query) use ($request,$village) {
                        return $query->where('police_station_id', $request->police_station)
                            ->where('word_id', $request->word)
                            ->where('village', $request->village)
                            ->whereNotIn('id',[$village->id]);
                    }),
                ],
        ]);

        $request['country_id'] = $request->country;
        $request['division_id'] = $request->division;
        $request['city_id'] = $request->city;
        $request['police_station_id'] = $request->police_station;
        $request['word_id'] = $request->word;

        if ($village->update($request->all())) {
            return response()->json(['success' => 'Village updated successfully']);
        } else {
            return response()->json(['error' => 'Failed to update Village']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Village $village
     * @return Response
     */
    public function destroy(Village $village)
    {
        if ($village->delete()) {
            return response()->json(['success' => 'Village deleted successfully']);
        } else {
            return response()->json(['error' => 'Failed to delete Village']);
        }
    }
}
