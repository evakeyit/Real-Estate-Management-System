<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyApiController extends Controller
{
    public function index()
    {
        return response()->json(Property::latest('property_id')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0'],
            'location' => ['required', 'string', 'max:255'],
        ]);

        $property = Property::create($validated);

        return response()->json($property, 201);
    }

    public function show(Property $property)
    {
        return response()->json($property);
    }

    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'type' => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0'],
            'location' => ['required', 'string', 'max:255'],
        ]);

        $property->update($validated);

        return response()->json($property);
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return response()->json(['message' => 'Property deleted successfully.']);
    }
}
