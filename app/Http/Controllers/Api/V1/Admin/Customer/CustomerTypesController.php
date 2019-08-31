<?php

namespace App\Http\Controllers\Api\V1\Admin\Customer;

use App\Models\CustomerType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => CustomerType::orderBy('type')->get()]);
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
            'type' => 'required|string|unique:customer_types,type'
        ]);

        if (CustomerType::create($request->all())) {
            return response()->json(['success' => 'Customer Type added successfully']);
        } else {
            return response()->json(['error' => 'Failed to add Customer Type']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerType  $customerType
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerType $customerType)
    {
        return response()->json(['data' => $customerType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerType  $customerType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerType $customerType)
    {
        $this->validate($request, [
            'type' => 'required|string|unique:customer_types,type,'.$customerType->id
        ]);

        if ($customerType->update($request->all())) {
            return response()->json(['success' => 'Customer Type updated successfully']);
        } else {
            return response()->json(['error' => 'Failed to update Customer Type']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerType  $customerType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerType $customerType)
    {
        if ($customerType->delete()) {
            return response()->json(['success' => 'Customer Type deleted successfully']);
        } else {
            return response()->json(['error' => 'Failed to delete Customer Type']);
        }
    }
}
