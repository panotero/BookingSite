<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Price;

use App\Services\FileUploadService;

use App\Services\ArrayMediaService;

class RoomController extends Controller
{

    protected $fileUploadService, $arrayMediaService;


    public function __construct(FileUploadService $fileUploadService, ArrayMediaService $arrayMediaService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->arrayMediaService = $arrayMediaService;
    }

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

    public function getRoom($roomID)
    {
        $room = Room::where('id', $roomID)->first();
        return response()->json([
            'success' => true,
            'data' => $room,
            'message' => "success"
        ]);
    }

    public function deleteRoomPhoto(Request $request)
    {
        try {

            //get room info first
            $room = Room::where('id', $request->roomID)->first();
            $photo = $request->photo;

            //delete the photo from array and storage
            $response = $this->arrayMediaService->removeItem($room, 'photos', $photo);
            //commit db

            //return response
            return response()->json([
                'success' => true,
                'message' => $response
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $ex
            ]);
        }
    }

    public function addRoomPhoto(Request $request)
    {

        $room = Room::where('id', $request->roomID)->first();

        $files = $request->file('photos');

        if (!$files) {
            return response()->json([
                'success' => false,
                'message' => 'No files uploaded.'
            ], 422);
        }

        $uploadedUrls = $this->fileUploadService->uploadFile(
            $files,
            'uploads/rooms'
        );

        $this->arrayMediaService->addItems(
            $room,
            'photos',
            $uploadedUrls
        );

        return response()->json([
            'success' => true,
            'photos' => $room->fresh()->photos
        ]);
    }

    public function getRoomByHotel($hotelID, Request $request)
    {
        // dd($hotelID);
        DB::beginTransaction();
        $result = Room::with('prices')->where('hotel_id', $hotelID)->get();
        DB::commit();
        if (count($result) <= 0) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'No Room found',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $result
        ]);
    }
    public function deleteRoomByHotel($roomID, Request $request)
    {
        try {

            DB::beginTransaction();
            $room = Room::findOrFail($roomID);
            $roomPhotos =  $room->photos;
            foreach ($roomPhotos as $photo) {
                $this->fileUploadService->deleteFile($photo);
            }

            $room->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Room deleted successfully',
            ]);
        } catch (\Exception $ex) {

            return response()->json([
                'success' => false,
                'message' => $ex,
            ]);
        }
    }

    public function addNewRoom(Request $request)
    {
        // dd($request->all());
        try {

            DB::beginTransaction();
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
                        'hotel_id' => $request->hotelID,
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
                'message' => 'Room Added successfully',
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $ex,
            ]);
        }
    }
}
