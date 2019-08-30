<?php

namespace App\Http\Controllers\Api\V1\Admin\House;

use App\Http\Controllers\Controller;
use App\Models\HouseType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HouseTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(['data' => HouseType::orderBy('name')->get()]);
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
            'name' => 'required|string|unique:house_types,name'
        ]);

        if (HouseType::create($request->all())) {
            return response()->json(['success' => 'House Type added successfully']);
        } else {
            return response()->json(['error' => 'Failed to add House Type']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param HouseType $house_type
     * @return Response
     */
    public function show(HouseType $house_type)
    {
        return response()->json(['data' => $house_type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param HouseType $house_type
     * @return Response
     */
    public function update(Request $request, HouseType $house_type)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:house_types,name,'.$house_type->id
        ]);

        if ($house_type->update($request->all())) {
            return response()->json(['success' => 'House Type updated successfully']);
        } else {
            return response()->json(['error' => 'Failed to update House Type']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param HouseType $house_type
     * @return Response
     */
    public function destroy(HouseType $house_type)
    {
        if ($house_type->delete()) {
            return response()->json(['success' => 'House Type deleted successfully']);
        } else {
            return response()->json(['error' => 'Failed to delete House Type']);
        }
    }
}
