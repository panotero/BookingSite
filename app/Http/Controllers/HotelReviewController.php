<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\HotelReview;
use Illuminate\Http\Request;

class HotelReviewController extends Controller
{
    public function index()
    {
        return response()->json(
            HotelReview::with('hotel')->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels_table,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'reviewer_name' => 'required|string|max:255',
            'reviewer_email' => 'required|email|max:255',
            'reviewer_contact' => 'required|string|max:255',
        ]);

        $review = HotelReview::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Review created successfully',
            'data' => $review,
        ]);
    }

    public function show($id)
    {
        return response()->json(
            HotelReview::with('hotel')->findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $review = HotelReview::findOrFail($id);

        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels_table,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'reviewer_name' => 'required|string|max:255',
            'reviewer_email' => 'required|email|max:255',
            'reviewer_contact' => 'required|string|max:255',
        ]);

        $review->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Review updated successfully',
            'data' => $review,
        ]);
    }

    public function destroy($id)
    {
        $review = HotelReview::findOrFail($id);

        $review->delete();

        return response()->json([
            'success' => true,
            'message' => 'Review deleted successfully',
        ]);
    }
}
