<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\DB;
use App\Models\Room;
use App\Models\Price;
use App\Models\HotelForm;

use App\Services\ArrayMediaService;

class HotelController extends Controller
{


    protected $fileUploadService, $arrayMediaService;


    public function __construct(FileUploadService $fileUploadService, ArrayMediaService $arrayMediaService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->arrayMediaService = $arrayMediaService;
    }
    public function index($hotelID)
    {

        $hotel = Hotel::with(
            'rooms.prices',
            'reviews',
            'forms'
        )->where('id', $hotelID)->first();


        return response()->json([
            'success' => true,
            'data' => $hotel,
            'message' => "success",
        ]);
    }
    public function home()
    {
        return view('clients.home');
    }
    public function hotel()
    {
        return view('clients.hotel');
    }
    public  function hotels()
    {

        return view('clients.hotels');
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
        // dd($request->file('hotel.logo'));
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

            if (isset($hotelData['logo'])) {

                $uploaded = $this->fileUploadService->uploadFile(
                    [$hotelData['logo']], // must be array
                    'uploads/hotels'
                );

                $hotelData['logo'] = $uploaded[0]; // IMPORTANT: string only
            }
            // dd($hotelLogo);


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
                'logo' => $hotelData['logo'],
            ]);

            $externalFormUrl = HotelForm::create([
                'hotel_id' => $hotel->id,
                'form_url' => $hotelData['external_form_url']
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
            'reviews',
            'forms'
        ])->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $hotels
        ]);
    }
    public function getHotel($id, Request $request)
    {
        $hotel = Hotel::with([
            'rooms.prices',
            'reviews',
            'forms'
        ])->where('id', $id)->first();

        return response()->json([
            'success' => true,
            'data' => $hotel
        ]);
    }

    public function deleteHotel($id, Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            //put the db transaction here
            $Hotel = Hotel::with('rooms')->where('id', $request->id)->first();
            // dd($Hotel);

            $this->fileUploadService->deleteFile($Hotel->logo);

            //delete files from the
            $photosDIR = $Hotel->photos;
            foreach ($photosDIR as $photo) {
                $this->fileUploadService->deleteFile($photo);
            }

            //check if there is room
            if ($Hotel->rooms) {
                foreach ($Hotel->rooms as $room) {
                    foreach ($room->photos as $roomphotos) {

                        $this->fileUploadService->deleteFile($roomphotos);
                    }
                }
            }

            //call the delete
            $response = $Hotel->delete();
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


    public function deleteHotelPhoto(Request $request)
    {

        try {

            //get room info first
            $hotel = Hotel::where('id', $request->roomID)->first();
            $photo = $request->photo;

            //delete the photo from array and storage
            $response = $this->arrayMediaService->removeItem($hotel, 'photos', $photo);
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
    public function addHotelPhoto(Request $request)
    {
        $hotel = Hotel::findOrFail($request->hotelID);

        $files = $request->file('photos');

        if (!$files) {
            return response()->json([
                'success' => false,
                'message' => 'No files uploaded.'
            ], 422);
        }

        $uploadedUrls = $this->fileUploadService->uploadFile(
            $files,
            'uploads/hotels'
        );

        $this->arrayMediaService->addItems(
            $hotel,
            'photos',
            $uploadedUrls
        );

        return response()->json([
            'success' => true,
            'photos' => $hotel->fresh()->photos
        ]);
    }
}
