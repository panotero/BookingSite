<div class="container mx-auto space-y-5">
    {{-- OPEN MODAL BUTTON --}}
    <button id="openHotelModal" class="bg-blue-500 hover:bg-blue-700 text-white px-5 py-2 rounded-xl text-sm font-medium">
        Add Hotel
    </button>

    <div id="hotelContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6"></div>



</div>

{{-- MODAL --}}
<div id="HotelModal" class="fixed inset-0 hidden z-40 flex items-center justify-center bg-black/50 px-4 modal">

    <div class="bg-white rounded-2xl shadow-2xl w-full lg:max-w-[80vw] max-h-[90vh] overflow-y-auto">

        {{-- Header --}}
        <div class="w-full p-5 flex justify-between items-center text-black border-b">

            <p class="text-xl font-semibold">
                Add Hotel
            </p>

            <button class="modal-close text-gray-500 hover:text-black text-xl">
                ✕
            </button>

        </div>

        {{-- FORM --}}
        <form id="hotelForm">

            {{-- Contents --}}
            <div class="max-h-[70vh] overflow-y-auto space-y-8 p-5">

                {{-- ========================= --}}
                {{-- HOTEL INFO --}}
                {{-- ========================= --}}

                <div class="space-y-5">

                    <p class="text-lg font-semibold border-b pb-2">
                        Hotel Information
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Hotel Name
                            </label>

                            <input type="text" id="hotel_name" class="w-full border rounded-xl px-4 py-3 mt-1"
                                placeholder="Ocean Paradise Resort" required>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Province
                            </label>

                            <input type="text" id="hotel_province" class="w-full border rounded-xl px-4 py-3 mt-1"
                                placeholder="Aklan" required>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                City
                            </label>

                            <input type="text" id="hotel_city" class="w-full border rounded-xl px-4 py-3 mt-1"
                                placeholder="Malay" required>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Full Address
                            </label>

                            <input type="text" id="hotel_full_address"
                                class="w-full border rounded-xl px-4 py-3 mt-1" placeholder="123 Beach Road" required>
                        </div>

                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">
                            Description
                        </label>

                        <textarea id="hotel_description" rows="4" class="w-full border rounded-xl px-4 py-3 mt-1"
                            placeholder="Luxury beachfront hotel" required></textarea>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">
                            External Form Url
                        </label>

                        <input type="text" id="hotel_external_form_url"
                            class="w-full border rounded-xl px-4 py-3 mt-1" placeholder="https://forms.google.com"
                            required>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">
                            Hotel Logo
                        </label>

                        <input type="file" id="hotel_logo" class="w-full border rounded-xl px-4 py-3 mt-1" required>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">
                            Hotel Photos
                        </label>

                        <input type="file" id="hotel_photos" multiple class="w-full border rounded-xl px-4 py-3 mt-1"
                            required>
                    </div>

                </div>



                {{-- ========================= --}}
                {{-- ROOMS CONTAINER --}}
                {{-- ========================= --}}

                <div>

                    <div class="flex justify-between items-center border-b pb-3 mb-5">

                        <p class="text-lg font-semibold">
                            Rooms
                        </p>

                        <button type="button" id="addRoomBtn"
                            class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded-xl text-sm">
                            Add Room
                        </button>

                    </div>

                    <div id="roomsContainer" class="space-y-8"></div>

                </div>

            </div>

            {{-- Footer --}}
            <div class="border-t border-gray-200 px-6 py-4 mt-auto flex justify-end gap-3">

                <button type="submit" id="proceedBtn"
                    class="bg-blue-500 border border-gray-300 text-gray-200 hover:bg-blue-800 px-5 py-2 rounded-lg text-sm font-medium">
                    Proceed
                </button>

                <button type="button"
                    class="modal-close border border-gray-300 text-gray-700 hover:bg-gray-100 px-5 py-2 rounded-lg text-sm font-medium">
                    Cancel
                </button>

            </div>

        </form>

    </div>

</div>
{{-- MODAL --}}
<div id="RoomInfoModal" class="fixed inset-0 hidden z-50 flex items-center justify-center bg-black/50 px-4 modal">

    <div class="bg-white rounded-2xl shadow-2xl w-full lg:max-w-[80vw] max-h-[90vh] overflow-y-auto">

        {{-- Header --}}
        <div class="w-full p-5 flex justify-between items-center text-black border-b">

            <p class="text-xl font-semibold">
                Room Info
            </p>

            <button class="modal-close text-gray-500 hover:text-black text-xl">
                ✕
            </button>

        </div>


        <form id="RoomInfoForm">
            {{-- Contents --}}
            <div class="max-h-[70vh] overflow-y-auto space-y-8 p-5">


                <div class="border rounded-2xl p-5 space-y-5 bg-gray-50 roominfo-card">



                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Room Name
                            </label>

                            <input type="text" class="room_name w-full border rounded-xl px-4 py-3 mt-1"
                                placeholder="Deluxe Ocean View">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Room Area
                            </label>

                            <input type="text" class="room_area w-full border rounded-xl px-4 py-3 mt-1"
                                placeholder="45 sqm">
                        </div>

                    </div>



                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Guest Capacity
                            </label>

                            <input type="number" class="guest_capacity w-full border rounded-xl px-4 py-3 mt-1"
                                placeholder="4">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Bed Count
                            </label>

                            <input type="number" class="bed_count w-full border rounded-xl px-4 py-3 mt-1"
                                placeholder="2">
                        </div>

                    </div>



                    <div>
                        <label class="text-sm font-medium text-gray-700">
                            Room Description
                        </label>

                        <textarea rows="3" class="room_description w-full border rounded-xl px-4 py-3 mt-1"
                            placeholder="Ocean facing room"></textarea>
                    </div>



                    <div>
                        <label class="text-sm font-medium text-gray-700">
                            Room Photos
                        </label>

                        <input type="file" multiple class="room_photos w-full border rounded-xl px-4 py-3 mt-1">
                    </div>




                    {{-- PRICE SECTION --}}

                    <div class="space-y-4">

                        <div class="flex justify-between items-center">

                            <p class="font-semibold">
                                Room Prices
                            </p>

                        </div>

                        <div class="pricesContainer space-y-4">
                            <div
                                class="grid grid-cols-1 md:grid-cols-2 gap-4 border rounded-xl p-4 bg-white price-card">

                                <div>
                                    <label class="text-sm font-medium text-gray-700">
                                        Price
                                    </label>

                                    <input type="number" class="price w-full border rounded-xl px-4 py-3 mt-1"
                                        placeholder="12000">
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-700">
                                        Discounted Price
                                    </label>

                                    <input type="number"
                                        class="discounted_price w-full border rounded-xl px-4 py-3 mt-1"
                                        placeholder="9999">
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="w-full flex justify-between align-middle gap-3 mb-4">

                    <h3 class="text-lg font-semibold">Rooms Photos</h3>
                    <button type="button" id="addRoomPhotoBtn"
                        class="bg-green-500 hover:bg-green-700 text-white px-2 rounded-xl text-sm">
                        Add Photo
                    </button>

                </div>
                <div id="roomPhotoContainer" class="grid grid-cols-2 md:grid-cols-6 gap-4">

                </div>
            </div>
        </form>


        {{-- Footer --}}
        <div class="border-t border-gray-200 px-6 py-4 mt-auto flex justify-end gap-3">

            <button type="submit" id="saveRoomInfo"
                class="bg-blue-500 border border-gray-300 text-gray-200 hover:bg-blue-800 px-5 py-2 rounded-lg text-sm font-medium">
                Save
            </button>

            <button type="button"
                class="modal-close border border-gray-300 text-gray-700 hover:bg-gray-100 px-5 py-2 rounded-lg text-sm font-medium">
                Cancel
            </button>

        </div>


    </div>

</div>
<div id="AddHotelPhotoModal"
    class="fixed inset-0 hidden z-50 flex items-center justify-center bg-black/50 px-4 modal">

    <div class="bg-white rounded-2xl shadow-2xl w-full lg:max-w-[80vw] max-h-[90vh] overflow-y-auto">

        {{-- Header --}}
        <div class="w-full p-5 flex justify-between items-center text-black border-b">

            <p class="text-xl font-semibold">
                Add Hotel Photo
            </p>

            <button class="modal-close text-gray-500 hover:text-black text-xl">
                ✕
            </button>

        </div>

        <form id="addHotelPhotoForm">

            <div class="max-h-[70vh] overflow-y-auto p-6 space-y-6">

                <!-- HEADER -->
                <div class="text-center space-y-1">
                    <h2 class="text-lg font-semibold text-gray-800">Add Hotel Photos</h2>
                    <p class="text-sm text-gray-500">Upload multiple images for this hotel</p>
                </div>

                <!-- UPLOAD BOX -->
                <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 bg-gray-50">

                    <input type="file" multiple class="hotel_photos hidden" id="hotelPhotoInput">

                    <label for="hotelPhotoInput" class="cursor-pointer block text-center space-y-2">

                        <div class="text-sm font-medium text-gray-700">
                            Click to upload or drag & drop
                        </div>

                        <div class="text-xs text-gray-500">
                            PNG, JPG, JPEG
                        </div>

                        <div class="mt-2">
                            <span class="inline-block px-4 py-2 bg-blue-600 text-white text-sm rounded-lg">
                                Choose Photos
                            </span>
                        </div>

                    </label>

                    <!-- FILE INFO -->
                    <div id="hotelPhotoInfo" class="mt-4 text-sm text-gray-700 space-y-1"></div>

                </div>

            </div>

        </form>


        {{-- Footer --}}
        <div class="border-t border-gray-200 px-6 py-4 mt-auto flex justify-end gap-3">

            <button type="submit" id="submithotelphoto"
                class="bg-blue-500 border border-gray-300 text-gray-200 hover:bg-blue-800 px-5 py-2 rounded-lg text-sm font-medium">
                Save
            </button>

            <button type="button"
                class="modal-close border border-gray-300 text-gray-700 hover:bg-gray-100 px-5 py-2 rounded-lg text-sm font-medium">
                Cancel
            </button>

        </div>


    </div>

</div>
<div id="AddRoomPhotoModal" class="fixed inset-0 hidden z-50 flex items-center justify-center bg-black/50 px-4 modal">

    <div class="bg-white rounded-2xl shadow-2xl w-full lg:max-w-[80vw] max-h-[90vh] overflow-y-auto">

        {{-- Header --}}
        <div class="w-full p-5 flex justify-between items-center text-black border-b">

            <p class="text-xl font-semibold">
                Add Room Photo
            </p>

            <button class="modal-close text-gray-500 hover:text-black text-xl">
                ✕
            </button>

        </div>


        <form id="addRoomPhotoForm">

            <div class="max-h-[70vh] overflow-y-auto p-6 space-y-6">

                <!-- HEADER -->
                <div class="text-center space-y-1">
                    <h2 class="text-lg font-semibold text-gray-800">Add Room Photos</h2>
                    <p class="text-sm text-gray-500">Upload multiple images for this hotel</p>
                </div>

                <!-- UPLOAD BOX -->
                <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 bg-gray-50">

                    <input type="file" multiple class="room_photos hidden" id="roomPhotoInput">

                    <label for="roomPhotoInput" class="cursor-pointer block text-center space-y-2">

                        <div class="text-sm font-medium text-gray-700">
                            Click to upload or drag & drop
                        </div>

                        <div class="text-xs text-gray-500">
                            PNG, JPG, JPEG
                        </div>

                        <div class="mt-2">
                            <span class="inline-block px-4 py-2 bg-blue-600 text-white text-sm rounded-lg">
                                Choose Photos
                            </span>
                        </div>

                    </label>

                    <!-- FILE INFO -->
                    <div id="roomPhotoInfo" class="mt-4 text-sm text-gray-700 space-y-1"></div>

                </div>

                <!-- PREVIEW AREA -->
                <div id="photoPreviewContainer" class="grid grid-cols-3 gap-3"></div>

            </div>

        </form>


        {{-- Footer --}}
        <div class="border-t border-gray-200 px-6 py-4 mt-auto flex justify-end gap-3">

            <button type="submit" id="submitroomphoto"
                class="bg-blue-500 border border-gray-300 text-gray-200 hover:bg-blue-800 px-5 py-2 rounded-lg text-sm font-medium">
                Save
            </button>

            <button type="button"
                class="modal-close border border-gray-300 text-gray-700 hover:bg-gray-100 px-5 py-2 rounded-lg text-sm font-medium">
                Cancel
            </button>

        </div>


    </div>

</div>

{{-- MODAL --}}
<div id="RoomModal" class="fixed inset-0 hidden z-50 flex items-center justify-center bg-black/50 px-4 modal">

    <div class="bg-white rounded-2xl shadow-2xl w-full lg:max-w-[80vw] max-h-[90vh] overflow-y-auto">

        {{-- Header --}}
        <div class="w-full p-5 flex justify-between items-center text-black border-b">

            <p class="text-xl font-semibold">
                Add Room
            </p>

            <button class="modal-close text-gray-500 hover:text-black text-xl">
                ✕
            </button>

        </div>


        <form id="addRoomForm">
            {{-- Contents --}}
            <div class="max-h-[70vh] overflow-y-auto space-y-8 p-5">


                <div class="border rounded-2xl p-5 space-y-5 bg-gray-50 addroom-card">



                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Room Name
                            </label>

                            <input type="text" class="room_name w-full border rounded-xl px-4 py-3 mt-1"
                                placeholder="Deluxe Ocean View">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Room Area
                            </label>

                            <input type="text" class="room_area w-full border rounded-xl px-4 py-3 mt-1"
                                placeholder="45 sqm">
                        </div>

                    </div>



                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Guest Capacity
                            </label>

                            <input type="number" class="guest_capacity w-full border rounded-xl px-4 py-3 mt-1"
                                placeholder="4">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Bed Count
                            </label>

                            <input type="number" class="bed_count w-full border rounded-xl px-4 py-3 mt-1"
                                placeholder="2">
                        </div>

                    </div>



                    <div>
                        <label class="text-sm font-medium text-gray-700">
                            Room Description
                        </label>

                        <textarea rows="3" class="room_description w-full border rounded-xl px-4 py-3 mt-1"
                            placeholder="Ocean facing room"></textarea>
                    </div>



                    <div>
                        <label class="text-sm font-medium text-gray-700">
                            Room Photos
                        </label>

                        <input type="file" multiple class="room_photos w-full border rounded-xl px-4 py-3 mt-1">
                    </div>




                    {{-- PRICE SECTION --}}

                    <div class="space-y-4">

                        <div class="flex justify-between items-center">

                            <p class="font-semibold">
                                Room Prices
                            </p>

                        </div>

                        <div class="pricesContainer space-y-4">
                            <div
                                class="grid grid-cols-1 md:grid-cols-2 gap-4 border rounded-xl p-4 bg-white price-card">

                                <div>
                                    <label class="text-sm font-medium text-gray-700">
                                        Price
                                    </label>

                                    <input type="number" class="price w-full border rounded-xl px-4 py-3 mt-1"
                                        placeholder="12000">
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-700">
                                        Discounted Price
                                    </label>

                                    <input type="number"
                                        class="discounted_price w-full border rounded-xl px-4 py-3 mt-1"
                                        placeholder="9999">
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Footer --}}
            <div class="border-t border-gray-200 px-6 py-4 mt-auto flex justify-end gap-3">

                <button type="submit" id="saveNewRoom"
                    class="bg-blue-500 border border-gray-300 text-gray-200 hover:bg-blue-800 px-5 py-2 rounded-lg text-sm font-medium">
                    Proceed
                </button>

                <button type="button"
                    class="modal-close border border-gray-300 text-gray-700 hover:bg-gray-100 px-5 py-2 rounded-lg text-sm font-medium">
                    Cancel
                </button>

            </div>
        </form>


    </div>

</div>

<div id="HotelInfoModal" class="fixed inset-0 hidden z-40 bg-black/50 flex items-center justify-center px-4">

    <div class="bg-white w-full max-w-6xl max-h-[90vh] overflow-y-auto rounded-2xl shadow-xl">

        <!-- HEADER -->
        <div class="p-5 border-b flex justify-between items-center">

            <h2 id="modalHotelTitle" class="text-xl font-semibold">Hotel Info</h2>
            <div>
                <button type="button" id="editHotelBtn"
                    class=" p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487a2.25 2.25 0 113.182 3.182L8.25 19.463 3 21l1.537-5.25L16.862 4.487z" />
                    </svg>
                </button>
                <button class="modal-close text-xl">✕</button>
            </div>


        </div>
        <!-- CONTENT -->
        <div class="p-5 space-y-8">

            <form id="modalInfoForm">
                <!-- HOTEL INFO -->
                <div class="space-y-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Name
                        </label>
                        <input type="text" id="modalHotelName"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-300 " disabled>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Description
                        </label>
                        <input type="text" id="modalHotelDesc"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-300" disabled>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Address
                        </label>
                        <input type="text" id="modalHotelAddress"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-300" disabled>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            External Form URL
                        </label>
                        <input type="text" id="modalHotelExteralForm"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-300" disabled>
                    </div>

            </form>


            <div class="w-full flex justify-between align-middle gap-3 mb-4">

                <h3 class="text-lg font-semibold">Hotel Photos</h3>
                <button type="button" id="addHotelPhotoBtn"
                    class="bg-green-500 hover:bg-green-700 text-white px-2 rounded-xl text-sm">
                    Add Photo
                </button>

            </div>

            <div id="hotelPhotoContainer" class="grid grid-cols-2 md:grid-cols-6 gap-4">
            </div>
        </div>

        <!-- ROOMS -->
        <div>
            <div class="w-full flex justify-between align-middle gap-3 mb-4">

                <h3 class="text-lg font-semibold">Rooms</h3>

                <button type="button" id="addRoomNewBtn"
                    class="bg-green-500 hover:bg-green-700 text-white px-2 rounded-xl text-sm">
                    Add Room
                </button>
            </div>
            <div id="roomContainer" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
        </div>

        <!-- REVIEWS -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Reviews</h3>
            <div id="reviewContainer" class="space-y-3"></div>
        </div>

    </div>


    <div class="p-4 border-t flex justify-end">

        <button type="submit" id="saveNinfo"
            class="hidden bg-blue-500 border border-gray-300 text-gray-200 hover:bg-blue-800 px-5 py-2 rounded-lg text-sm font-medium">
            Save
        </button>
        <button class="modal-close bg-gray-200 px-4 py-2 rounded-lg">
            Close
        </button>
    </div>

</div>

</div>
<script>
    (function() {
        initHotelFunction();
    })();
</script>
