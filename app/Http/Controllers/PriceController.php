<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        return response()->json(
            Price::with('room')->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms_table,id',
            'price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
        ]);

        $price = Price::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Price created successfully',
            'data' => $price,
        ]);
    }

    public function show($id)
    {
        return response()->json(
            Price::with('room')->findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $price = Price::findOrFail($id);

        $validated = $request->validate([
            'room_id' => 'required|exists:rooms_table,id',
            'price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
        ]);

        $price->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Price updated successfully',
            'data' => $price,
        ]);
    }

    public function destroy($id)
    {
        $price = Price::findOrFail($id);

        $price->delete();

        return response()->json([
            'success' => true,
            'message' => 'Price deleted successfully',
        ]);
    }
}
