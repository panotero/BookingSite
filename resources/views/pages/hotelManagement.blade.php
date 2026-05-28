<div class="container mx-auto space-y-5">
    {{-- OPEN MODAL BUTTON --}}
    <button id="openHotelModal" class="bg-blue-500 hover:bg-blue-700 text-white px-5 py-2 rounded-xl text-sm font-medium">
        Add Hotel
    </button>

    <div id="hotelContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6"></div>



</div>
{{-- MODAL --}}
<div id="DocumentModal" class="fixed inset-0 hidden z-40 flex items-center justify-center bg-black/50 px-4 modal">

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
                                placeholder="Ocean Paradise Resort">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Province
                            </label>

                            <input type="text" id="hotel_province" class="w-full border rounded-xl px-4 py-3 mt-1"
                                placeholder="Aklan">
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                City
                            </label>

                            <input type="text" id="hotel_city" class="w-full border rounded-xl px-4 py-3 mt-1"
                                placeholder="Malay">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Full Address
                            </label>

                            <input type="text" id="hotel_full_address"
                                class="w-full border rounded-xl px-4 py-3 mt-1" placeholder="123 Beach Road">
                        </div>

                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">
                            Description
                        </label>

                        <textarea id="hotel_description" rows="4" class="w-full border rounded-xl px-4 py-3 mt-1"
                            placeholder="Luxury beachfront hotel"></textarea>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">
                            Hotel Photos
                        </label>

                        <input type="file" id="hotel_photos" multiple
                            class="w-full border rounded-xl px-4 py-3 mt-1">
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

<div id="HotelModal" class="fixed inset-0 hidden z-50 bg-black/50 flex items-center justify-center px-4">

    <div class="bg-white w-full max-w-6xl max-h-[90vh] overflow-y-auto rounded-2xl shadow-xl">

        <!-- HEADER -->
        <div class="p-5 border-b flex justify-between items-center">

            <h2 id="modalHotelName" class="text-xl font-semibold"></h2>

            <button class="modal-close text-xl">✕</button>

        </div>

        <!-- CONTENT -->
        <div class="p-5 space-y-8">

            <!-- HOTEL INFO -->
            <div>
                <p id="modalHotelDesc" class="text-gray-600"></p>
                <p id="modalHotelAddress" class="text-sm text-gray-500 mt-1"></p>
            </div>

            <!-- ROOMS -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Rooms</h3>
                <div id="roomContainer" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
            </div>

            <!-- REVIEWS -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Reviews</h3>
                <div id="reviewContainer" class="space-y-3"></div>
            </div>

        </div>

        <div class="p-4 border-t flex justify-end">
            <button class="modal-close bg-gray-200 px-4 py-2 rounded-lg">
                Close
            </button>
        </div>

    </div>

</div>
<script>
    (function() {

        document.getElementById('openHotelModal').addEventListener("click", function() {

            initModal({
                modalId: "DocumentModal",
            });
        });


        let roomIndex = 0;

        $('#addRoomBtn').on('click', function() {

            let roomHtml = `

        <div class="border rounded-2xl p-5 space-y-5 bg-gray-50 room-card">

            <div class="flex justify-between items-center">

                <p class="font-semibold text-lg">
                    Room #${roomIndex + 1}
                </p>

                <button type="button"
                    class="removeRoomBtn bg-red-500 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm">
                    Remove
                </button>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="text-sm font-medium text-gray-700">
                        Room Name
                    </label>

                    <input type="text"
                        class="room_name w-full border rounded-xl px-4 py-3 mt-1"
                        placeholder="Deluxe Ocean View">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">
                        Room Area
                    </label>

                    <input type="text"
                        class="room_area w-full border rounded-xl px-4 py-3 mt-1"
                        placeholder="45 sqm">
                </div>

            </div>



            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="text-sm font-medium text-gray-700">
                        Guest Capacity
                    </label>

                    <input type="number"
                        class="guest_capacity w-full border rounded-xl px-4 py-3 mt-1"
                        placeholder="4">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">
                        Bed Count
                    </label>

                    <input type="number"
                        class="bed_count w-full border rounded-xl px-4 py-3 mt-1"
                        placeholder="2">
                </div>

            </div>



            <div>
                <label class="text-sm font-medium text-gray-700">
                    Room Description
                </label>

                <textarea rows="3"
                    class="room_description w-full border rounded-xl px-4 py-3 mt-1"
                    placeholder="Ocean facing room"></textarea>
            </div>



            <div>
                <label class="text-sm font-medium text-gray-700">
                    Room Photos
                </label>

                <input type="file"
                    multiple
                    class="room_photos w-full border rounded-xl px-4 py-3 mt-1">
            </div>




            {{-- PRICE SECTION --}}

            <div class="space-y-4">

                <div class="flex justify-between items-center">

                    <p class="font-semibold">
                        Room Prices
                    </p>

                    <button type="button"
                        class="addPriceBtn bg-indigo-500 hover:bg-indigo-700 text-white px-3 py-2 rounded-lg text-sm">
                        Add Price
                    </button>

                </div>

                <div class="pricesContainer space-y-4"></div>

            </div>

        </div>

        `;

            $('#roomsContainer').append(roomHtml);

            roomIndex++;

        });




        // =========================
        // REMOVE ROOM
        // =========================

        $(document).on('click', '.removeRoomBtn', function() {

            $(this).closest('.room-card').remove();

        });




        // =========================
        // ADD PRICE
        // =========================

        $(document).on('click', '.addPriceBtn', function() {

            let priceHtml = `

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border rounded-xl p-4 bg-white price-card">

            <div>
                <label class="text-sm font-medium text-gray-700">
                    Price
                </label>

                <input type="number"
                    class="price w-full border rounded-xl px-4 py-3 mt-1"
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

            <div class="flex items-end">
                <button type="button"
                    class="removePriceBtn bg-red-500 hover:bg-red-700 text-white px-4 py-3 rounded-xl text-sm w-full">
                    Remove
                </button>
            </div>

        </div>

        `;

            $(this).closest('.room-card').find('.pricesContainer').append(priceHtml);

        });




        // =========================
        // REMOVE PRICE
        // =========================

        $(document).on('click', '.removePriceBtn', function() {

            $(this).closest('.price-card').remove();

        });



        $('#hotelForm').on('submit', async function(e) {

            e.preventDefault();

            const formData = new FormData();



            // =========================
            // HOTEL INFO
            // =========================

            formData.append('hotel[name]', $('#hotel_name').val());
            formData.append('hotel[description]', $('#hotel_description').val());
            formData.append('hotel[full_address]', $('#hotel_full_address').val());
            formData.append('hotel[province]', $('#hotel_province').val());
            formData.append('hotel[city]', $('#hotel_city').val());




            // =========================
            // HOTEL PHOTOS
            // =========================

            let hotelPhotos = $('#hotel_photos')[0].files;

            for (let i = 0; i < hotelPhotos.length; i++) {

                formData.append('hotel[photos][]', hotelPhotos[i]);

            }




            // =========================
            // ROOMS
            // =========================

            $('.room-card').each(function(roomIndex) {

                formData.append(`rooms[${roomIndex}][room_name]`,
                    $(this).find('.room_name').val());

                formData.append(`rooms[${roomIndex}][description]`,
                    $(this).find('.room_description').val());

                formData.append(`rooms[${roomIndex}][guest_capacity]`,
                    $(this).find('.guest_capacity').val());

                formData.append(`rooms[${roomIndex}][bed_count]`,
                    $(this).find('.bed_count').val());

                formData.append(`rooms[${roomIndex}][room_area]`,
                    $(this).find('.room_area').val());



                // =========================
                // ROOM PHOTOS
                // =========================

                let roomPhotos = $(this).find('.room_photos')[0].files;

                for (let p = 0; p < roomPhotos.length; p++) {

                    formData.append(`rooms[${roomIndex}][photos][]`, roomPhotos[p]);

                }



                // =========================
                // ROOM PRICES
                // =========================

                $(this).find('.price-card').each(function(priceIndex) {

                    formData.append(
                        `rooms[${roomIndex}][prices][${priceIndex}][price]`,
                        $(this).find('.price').val()
                    );

                    formData.append(
                        `rooms[${roomIndex}][prices][${priceIndex}][discounted_price]`,
                        $(this).find('.discounted_price').val()
                    );

                });

            });




            postData(formData);

        });
        loadHotels();
        let HOTEL_DATA = [];

        async function loadHotels() {

            const res = await apiCall({
                mode: "GET",
                url: "/api/hotels/all",
                isJson: true
            });
            if (!res.success) {

                showMessage({
                    status: "error",
                    title: "Error Saving Options",
                    message: "There is some error saving your information. Please contact system administrator",
                });
                return;
            };

            HOTEL_DATA = res.data;

            renderHotels(HOTEL_DATA);
        }

        function renderHotels(hotels) {

            let html = '';

            hotels.forEach(hotel => {

                let cover = hotel.photos?.[0] ?? 'https://via.placeholder.com/400x250';

                html += `
        <div class="hotel-card relative bg-white border rounded-2xl overflow-hidden shadow-sm hover:shadow-lg cursor-pointer group"
             data-id="${hotel.id}">

            <!-- DELETE HOTEL -->
            <button class="deleteBtn absolute top-3 right-3 bg-red-500 text-white px-3 py-1 text-xs rounded-lg opacity-0 group-hover:opacity-100 transition"
                data-delete-id="hotel:${hotel.id}">
                Delete
            </button>

            <img src="${cover}" class="w-full h-48 object-cover">

            <div class="p-4">

                <h3 class="font-semibold text-lg">${hotel.name}</h3>

                <p class="text-sm text-gray-500">
                    ${hotel.city}, ${hotel.province}
                </p>

            </div>

        </div>
        `;
            });

            $('#hotelContainer').html(html);
        }
        $(document).on('click', '.hotel-card', function(e) {

            if ($(e.target).hasClass('deleteHotelBtn')) return;

            let id = $(this).data('id');

            let hotel = HOTEL_DATA.find(h => h.id == id);

            if (!hotel) return;

            $('#modalHotelName').text(hotel.name);
            $('#modalHotelDesc').text(hotel.description ?? '');
            $('#modalHotelAddress').text(`${hotel.full_address}`);

            renderRooms(hotel.rooms);
            renderReviews(hotel.reviews);

            initModal({
                modalId: "HotelModal"
            });


        });

        function renderRooms(rooms) {

            let html = '';

            rooms.forEach(room => {

                let img = room.photos?.[0] ?? 'https://via.placeholder.com/300';
                let price = room.prices?.[0];

                let priceText = price ?
                    `₱${price.discounted_price ?? price.price}` :
                    'No price';

                html += `
        <div class="relative border rounded-xl overflow-hidden shadow-sm room-card">

            <!-- DELETE ROOM -->
            <button class="deleteBtn absolute top-2 right-2 bg-red-500 text-white px-2 py-1 text-xs rounded-lg"
                data-delete-id="room:${room.id}">
                ✕
            </button>

            <img src="${img}" class="w-full h-40 object-cover">

            <div class="p-4 space-y-1">

                <h4 class="font-semibold">${room.room_name}</h4>

                <p class="text-sm text-gray-500">${room.description ?? ''}</p>

                <p class="text-blue-600 font-semibold text-sm">
                    ${priceText}
                </p>

            </div>

        </div>
        `;
            });

            $('#roomContainer').html(html);
        }

        function renderReviews(reviews) {

            if (!reviews || reviews.length === 0) {
                $('#reviewContainer').html(
                    `<p class="text-gray-400 text-sm">No reviews yet</p>`);
                return;
            }

            let html = '';

            reviews.forEach(r => {

                html += `
        <div class="border rounded-lg p-3">

            <div class="flex justify-between">

                <p class="font-semibold">${r.reviewer_name}</p>

                <p class="text-yellow-500 text-sm">
                    ${'★'.repeat(r.rating)}
                </p>

            </div>

            <p class="text-sm text-gray-600 mt-1">
                ${r.review}
            </p>

        </div>
        `;
            });

            $('#reviewContainer').html(html);
        }

        $(document).on('click', '.deleteBtn', function(e) {

            e.stopPropagation(); // prevents modal open / card click

            let id = $(this).data('delete-id');

            console.log(`delete trigger for: ${id}`);

        });
        // =========================
        // API CALL
        // =========================
        async function postData(formData) {

            const response = await apiCall({
                mode: "POST",
                isJson: false,
                payload: formData,
                url: "/api/hotels/complete",
                button: document.getElementById("proceedBtn")
            });

            if (!response.success) {

                showMessage({
                    status: "error",
                    title: "Error Saving Hotel",
                    message: "There is some error saving your information. Please contact system administrator",
                });
                return;
            };

            showMessage({
                status: "success",
                title: "Hotel Saved!",
            });
            clearInputs();
            closemodals();
            loadHotels();
            console.log(response);

        }
    })();
</script>
