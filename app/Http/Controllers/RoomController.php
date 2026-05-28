<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        return response()->json(
            Room::with(['hotel', 'prices'])->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels_table,id',
            'room_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photos' => 'nullable|array',
            'guest_capacity' => 'required|integer',
            'bed_count' => 'required|integer',
            'room_area' => 'required|string|max:255',
        ]);

        $room = Room::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Room created successfully',
            'data' => $room,
        ]);
    }

    public function show($id)
    {
        return response()->json(
            Room::with(['hotel', 'prices'])->findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels_table,id',
            'room_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photos' => 'nullable|array',
            'guest_capacity' => 'required|integer',
            'bed_count' => 'required|integer',
            'room_area' => 'required|string|max:255',
        ]);

        $room->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Room updated successfully',
            'data' => $room,
        ]);
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);

        $room->delete();

        return response()->json([
            'success' => true,
            'message' => 'Room deleted successfully',
        ]);
    }
}
