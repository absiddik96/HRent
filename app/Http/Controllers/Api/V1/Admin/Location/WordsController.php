<?php

namespace App\Http\Controllers\Api\V1\Admin\Location;

use App\Http\Controllers\Controller;
use App\Models\Location\Word;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class WordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(['data' => Word::orderBy('word_no')->get()]);
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
            'word_no' =>
                [
                    'required',
                    'string',
                    Rule::unique('words')->where(function ($query) use ($request) {
                        return $query->where('police_station_id', $request->police_station)
                            ->where('word_no', $request->word_no);
                    }),
                ],
        ]);

        $request['country_id'] = $request->country;
        $request['division_id'] = $request->division;
        $request['city_id'] = $request->city;
        $request['police_station_id'] = $request->police_station;

        if (Word::create($request->all())) {
            return response()->json(['success' => 'Word added successfully']);
        } else {
            return response()->json(['error' => 'Failed to add Word']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Word $word
     * @return Response
     */
    public function show(Word $word)
    {
        return response()->json(['data' => $word]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Word $word
     * @return Response
     */
    public function update(Request $request, Word $word)
    {
        $this->validate($request, [
            'country' => 'required|numeric',
            'division' => 'required|numeric',
            'city' => 'required|numeric',
            'police_station' => 'required|numeric',
            'word_no' =>
                [
                    'required',
                    'string',
                    Rule::unique('words')->where(function ($query) use ($request,$word) {
                        return $query->where('police_station_id', $request->police_station)
                            ->where('word_no', $request->word_no)
                            ->whereNotIn('id',[$word->id]);
                    }),
                ],
        ]);

        $request['country_id'] = $request->country;
        $request['division_id'] = $request->division;
        $request['city_id'] = $request->city;
        $request['police_station_id'] = $request->police_station;

        if ($word->update($request->all())) {
            return response()->json(['success' => 'Word updated successfully']);
        } else {
            return response()->json(['error' => 'Failed to update Word']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Word $word
     * @return Response
     */
    public function destroy(Word $word)
    {
        if ($word->delete()) {
            return response()->json(['success' => 'Word deleted successfully']);
        } else {
            return response()->json(['error' => 'Failed to delete Word']);
        }
    }
}
