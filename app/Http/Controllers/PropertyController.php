<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => Property::all()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate data
        $data = $request->validate([
            'address_line_1' => 'required|max:255',
            'address_line_2' => 'required|max:255',
            'city'           => 'required',
            'postcode'       => 'required|max:8'
        ]);

        // Grab coordinates
        $gmc = new GoogleMapsController;
        $coordinates = $gmc->getCoordinates($data);

        // Populate data
        $newProperty = new Property();

        $newProperty->address_line_1 = $data['address_line_1'];
        $newProperty->address_line_2 = $data['address_line_2'];
        $newProperty->city           = $data['city'];
        $newProperty->postcode       = $data['postcode'];
        $newProperty->latitude       = $coordinates['latitude'];
        $newProperty->longitude      = $coordinates['longitude'];

        $newProperty->save();

        return response()->json([
            'created' => true,
            'location' => url('api/property', [$newProperty->id])
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        return response()->json([
            'data' => $property
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        /// Validate data
        $data = $request->validate([
            'address_line_1' => 'required|max:255',
            'address_line_2' => 'required|max:255',
            'city'           => 'required',
            'postcode'       => 'required|max:8'
        ]);

        // Grab coordinates
        $gmc = new GoogleMapsController;
        $coordinates = $gmc->getCoordinates($data);

        // Populate data
        $property->address_line_1 = $data['address_line_1'];
        $property->address_line_2 = $data['address_line_2'];
        $property->city           = $data['city'];
        $property->postcode       = $data['postcode'];
        $property->latitude       = $coordinates['latitude'];
        $property->longitude      = $coordinates['longitude'];

        $property->save();

        return response()->json([
            'updated' => true,
            'location' => url('api/property', [$property->id])
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return response(null, 204);
    }
}
