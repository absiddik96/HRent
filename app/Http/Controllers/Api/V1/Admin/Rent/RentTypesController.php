<?php

namespace App\Http\Controllers\Api\V1\Admin\Rent;

use App\Http\Controllers\Controller;
use App\Models\RentType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RentTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(['data' => RentType::orderBy('name')->get()]);
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
            'name' => 'required|string|unique:rent_types,name'
        ]);

        if (RentType::create($request->all())) {
            return response()->json(['success' => 'Rent Type added successfully']);
        } else {
            return response()->json(['error' => 'Failed to add Rent Type']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param RentType $rentType
     * @return Response
     */
    public function show(RentType $rentType)
    {
        return response()->json(['data' => $rentType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param RentType $rentType
     * @return Response
     */
    public function update(Request $request, RentType $rentType)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:rent_types,name,'.$rentType->id
        ]);

        if ($rentType->update($request->all())) {
            return response()->json(['success' => 'Rent Type updated successfully']);
        } else {
            return response()->json(['error' => 'Failed to update Rent Type']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RentType $rentType
     * @return Response
     */
    public function destroy(RentType $rentType)
    {
        if ($rentType->delete()) {
            return response()->json(['success' => 'Rent Type deleted successfully']);
        } else {
            return response()->json(['error' => 'Failed to delete Rent Type']);
        }
    }
}
