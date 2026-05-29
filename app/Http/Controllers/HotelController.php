<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\DB;
use App\Models\Room;
use App\Models\Price;

class HotelController extends Controller
{

    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    public function index()
    {
        return response()->json(
            Hotel::with(['rooms.prices', 'reviews'])->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'full_address' => 'required|string',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'photos' => 'nullable|array',
        ]);

        $hotel = Hotel::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Hotel created successfully',
            'data' => $hotel,
        ]);
    }

    public function show($id)
    {
        $hotel = Hotel::with(['rooms.prices', 'reviews'])->findOrFail($id);

        return response()->json($hotel);
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'full_address' => 'required|string',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'photos' => 'nullable|array',
        ]);

        $hotel->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Hotel updated successfully',
            'data' => $hotel,
        ]);
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);

        $hotel->delete();

        return response()->json([
            'success' => true,
            'message' => 'Hotel deleted successfully',
        ]);
    }

    public function storeCompleteHotel(Request $request)
    {

        DB::beginTransaction();

        try {

            // =====================================================
            // HOTEL DATA
            // =====================================================

            $hotelData = $request->hotel;

            // =====================================================
            // HOTEL PHOTOS
            // =====================================================

            $hotelPhotos = [];

            if (
                isset($hotelData['photos']) &&
                is_array($hotelData['photos']) &&
                count($hotelData['photos']) > 0
            ) {

                $hotelPhotos = $this->fileUploadService->uploadFile(
                    $hotelData['photos'],
                    'uploads/hotels'
                );
            }

            // =====================================================
            // CREATE HOTEL
            // =====================================================

            $hotel = Hotel::create([
                'name' => $hotelData['name'] ?? null,
                'description' => $hotelData['description'] ?? null,
                'full_address' => $hotelData['full_address'] ?? null,
                'province' => $hotelData['province'] ?? null,
                'city' => $hotelData['city'] ?? null,
                'photos' => $hotelPhotos,
            ]);



            // =====================================================
            // ROOMS
            // =====================================================

            if (
                isset($request->rooms) &&
                is_array($request->rooms)
            ) {

                foreach ($request->rooms as $roomData) {

                    // =====================================================
                    // ROOM PHOTOS
                    // =====================================================

                    $roomPhotos = [];

                    if (
                        isset($roomData['photos']) &&
                        is_array($roomData['photos']) &&
                        count($roomData['photos']) > 0
                    ) {

                        $roomPhotos = $this->fileUploadService->uploadFile(
                            $roomData['photos'],
                            'uploads/rooms'
                        );
                    }

                    // =====================================================
                    // CREATE ROOM
                    // =====================================================

                    $room = Room::create([
                        'hotel_id' => $hotel->id,
                        'room_name' => $roomData['room_name'] ?? null,
                        'description' => $roomData['description'] ?? null,
                        'photos' => $roomPhotos,
                        'guest_capacity' => $roomData['guest_capacity'] ?? 0,
                        'bed_count' => $roomData['bed_count'] ?? 0,
                        'room_area' => $roomData['room_area'] ?? null,
                    ]);


                    // =====================================================
                    // ROOM PRICES
                    // =====================================================

                    if (
                        isset($roomData['prices']) &&
                        is_array($roomData['prices'])
                    ) {

                        foreach ($roomData['prices'] as $priceData) {

                            Price::create([
                                'room_id' => $room->id,
                                'price' => $priceData['price'] ?? 0,
                                'discounted_price' => $priceData['discounted_price'] ?? null,
                            ]);
                        }
                    }
                }
            }



            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Hotel created successfully',
                'data' => Hotel::with([
                    'rooms.prices'
                ])->find($hotel->id)
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ], 500);
        }
    }

    public function getAllHotels()
    {
        $hotels = Hotel::with([
            'rooms.prices',
            'reviews'
        ])->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $hotels
        ]);
    }

    public function deleteHotel($id, Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            //put the db transaction here
            $response = Hotel::where('id', $request->id)->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => $response
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }
}
