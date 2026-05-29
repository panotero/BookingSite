window.initHotelFunction = function initHotelFunction() {
  document
    .getElementById("openHotelModal")
    .addEventListener("click", function () {
      initModal({
        modalId: "DocumentModal",
      });
    });

  let roomIndex = 0;
  $("#addRoomNewBtn").on("click", function () {
    initModal({
      modalId: "AddRoomModal",
    });
  });

  $("#addRoomBtn").on("click", function () {
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

                </div>

                <div class="pricesContainer space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border rounded-xl p-4 bg-white price-card">

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

        </div></div>

            </div>

        </div>

        `;

    $("#roomsContainer").append(roomHtml);

    roomIndex++;
  });

  // =========================
  // REMOVE ROOM
  // =========================

  $(document).on("click", ".removeRoomBtn", function () {
    $(this).closest(".room-card").remove();
  });

  // =========================
  // REMOVE PRICE
  // =========================

  $(document).on("click", ".removePriceBtn", function () {
    $(this).closest(".price-card").remove();
  });

  $("#addRoomForm").on("submit", async function (e) {
    e.preventDefault();
    let hotelID = $(this).data("hotel-id");
    const formData = new FormData();
    formData.append("hotelID", hotelID);

    $(".addroom-card").each(function (roomIndex) {
      formData.append(
        `rooms[${roomIndex}][room_name]`,
        $(this).find(".room_name").val(),
      );

      formData.append(
        `rooms[${roomIndex}][description]`,
        $(this).find(".room_description").val(),
      );

      formData.append(
        `rooms[${roomIndex}][guest_capacity]`,
        $(this).find(".guest_capacity").val(),
      );

      formData.append(
        `rooms[${roomIndex}][bed_count]`,
        $(this).find(".bed_count").val(),
      );

      formData.append(
        `rooms[${roomIndex}][room_area]`,
        $(this).find(".room_area").val(),
      );

      // =========================
      // ROOM PHOTOS
      // =========================

      let roomPhotos = $(this).find(".room_photos")[0].files;

      for (let p = 0; p < roomPhotos.length; p++) {
        formData.append(`rooms[${roomIndex}][photos][]`, roomPhotos[p]);
      }

      // =========================
      // ROOM PRICES
      // =========================

      $(this)
        .find(".price-card")
        .each(function (priceIndex) {
          formData.append(
            `rooms[${roomIndex}][prices][${priceIndex}][price]`,
            $(this).find(".price").val(),
          );

          formData.append(
            `rooms[${roomIndex}][prices][${priceIndex}][discounted_price]`,
            $(this).find(".discounted_price").val(),
          );
        });
    });
    const response = await apiCall({
      mode: "POST",
      isJson: false,
      payload: formData,
      url: "/api/hotels/room/add",
      button: document.getElementById("saveNewRoom"),
    });

    if (!response.success) {
      showMessage({
        status: "error",
        title: "Error Adding Room",
        message:
          "There is some error saving your information. Please contact system administrator",
      });
      return;
    }

    showMessage({
      status: "success",
      title: "Room Added!",
    });
    clearInputs();

    renderRooms(hotelID);
    document.getElementById("AddRoomModal").classList.add("hidden");
  });
  $("#hotelForm").on("submit", async function (e) {
    e.preventDefault();

    const formData = new FormData();

    // =========================
    // HOTEL INFO
    // =========================

    formData.append("hotel[name]", $("#hotel_name").val());
    formData.append("hotel[description]", $("#hotel_description").val());
    formData.append("hotel[full_address]", $("#hotel_full_address").val());
    formData.append("hotel[province]", $("#hotel_province").val());
    formData.append("hotel[city]", $("#hotel_city").val());

    // =========================
    // HOTEL PHOTOS
    // =========================

    let hotelPhotos = $("#hotel_photos")[0].files;

    for (let i = 0; i < hotelPhotos.length; i++) {
      formData.append("hotel[photos][]", hotelPhotos[i]);
    }

    // =========================
    // ROOMS
    // =========================

    $(".room-card").each(function (roomIndex) {
      formData.append(
        `rooms[${roomIndex}][room_name]`,
        $(this).find(".room_name").val(),
      );

      formData.append(
        `rooms[${roomIndex}][description]`,
        $(this).find(".room_description").val(),
      );

      formData.append(
        `rooms[${roomIndex}][guest_capacity]`,
        $(this).find(".guest_capacity").val(),
      );

      formData.append(
        `rooms[${roomIndex}][bed_count]`,
        $(this).find(".bed_count").val(),
      );

      formData.append(
        `rooms[${roomIndex}][room_area]`,
        $(this).find(".room_area").val(),
      );

      // =========================
      // ROOM PHOTOS
      // =========================

      let roomPhotos = $(this).find(".room_photos")[0].files;

      for (let p = 0; p < roomPhotos.length; p++) {
        formData.append(`rooms[${roomIndex}][photos][]`, roomPhotos[p]);
      }

      // =========================
      // ROOM PRICES
      // =========================

      $(this)
        .find(".price-card")
        .each(function (priceIndex) {
          formData.append(
            `rooms[${roomIndex}][prices][${priceIndex}][price]`,
            $(this).find(".price").val(),
          );

          formData.append(
            `rooms[${roomIndex}][prices][${priceIndex}][discounted_price]`,
            $(this).find(".discounted_price").val(),
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
      isJson: true,
    });
    if (!res.success) {
      showMessage({
        status: "error",
        title: "Error Saving Options",
        message:
          "There is some error saving your information. Please contact system administrator",
      });
      return;
    }

    HOTEL_DATA = res.data;

    renderHotels(HOTEL_DATA);
  }

  function renderHotels(hotels) {
    let html = "";

    hotels.forEach((hotel) => {
      let cover = hotel.photos?.[0] ?? "https://via.placeholder.com/400x250";

      html += `
        <div class="hotel-card relative bg-white border rounded-2xl overflow-hidden shadow-sm hover:shadow-lg cursor-pointer group"
             data-id="${hotel.id}">

            <!-- DELETE HOTEL -->
            <button class="deleteBtn absolute top-3 right-3 bg-red-500 text-white px-3 py-1 text-xs rounded-lg opacity-0 group-hover:opacity-100 transition"
                data-delete-id="${hotel.id}">
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

    $("#hotelContainer").html(html);
  }
  $(document).on("click", ".hotel-card", function (e) {
    if ($(e.target).hasClass("deleteHotelBtn")) return;

    let id = $(this).data("id");

    let hotel = HOTEL_DATA.find((h) => h.id == id);

    if (!hotel) return;

    $("#modalHotelName").text(hotel.name);
    $("#modalHotelDesc").text(hotel.description ?? "");
    $("#modalHotelAddress").text(`${hotel.full_address}`);

    renderRooms(id);
    renderReviews(hotel.reviews);

    initModal({
      modalId: "HotelModal",
    });
    $("#addRoomForm").attr("data-hotel-id", id);
  });

  async function renderRooms(id) {
    $("#roomContainer")
      .html(`<div class="col-span-2 mx-auto w-full rounded-md border border-zinc-300 p-4">
  <div class="flex animate-pulse space-x-4">
    <div class="size-10 rounded-full bg-gray-200"></div>
    <div class="flex-1 space-y-6 py-1">
      <div class="h-2 rounded bg-gray-200"></div>
      <div class="space-y-3">
        <div class="grid grid-cols-3 gap-4">
          <div class="col-span-2 h-2 rounded bg-gray-200"></div>
          <div class="col-span-1 h-2 rounded bg-gray-200"></div>
        </div>
        <div class="h-2 rounded bg-gray-200"></div>
      </div>
    </div>
  </div>
</div>`);
    let html = "";

    const rooms = await apiCall({
      mode: "GET",
      url: `/api/hotels/rooms/${id}`,
      isJson: true,
    });

    rooms.data.forEach((room) => {
      let img = room.photos?.[0] ?? "https://via.placeholder.com/300";
      let price = room.prices?.[0];

      let priceText = price ? `₱${price.price}` : "No price";
      let discountedPrice = price
        ? `₱${price.discounted_price}`
        : "No Discounted Price";

      html += `
        <div class="relative border rounded-xl overflow-hidden shadow-sm room-card">

            <!-- DELETE ROOM -->
            <button class="deleteRoomBtn absolute top-2 right-2 bg-red-500 text-white px-2 py-1 text-xs rounded-lg"
                data-delete-id="${room.id}" data-hotel-id="${room.hotel_id}">
                ✕
            </button>

            <img src="${img}" class="w-full h-40 object-cover">

            <div class="p-4 space-y-1">

                <h4 class="font-semibold">${room.room_name}</h4>

                <p class="text-sm text-gray-500">${room.description ?? ""}</p>

                <p class="text-blue-600 font-semibold text-sm">
                    Price: ${priceText}
                </p>
                <p class="text-blue-600 font-semibold text-sm">
                    Discounted Price: ${discountedPrice}
                </p>

            </div>

        </div>
        `;
    });

    $("#roomContainer").html(html);
  }

  function renderReviews(reviews) {
    if (!reviews || reviews.length === 0) {
      $("#reviewContainer").html(
        `<p class="text-gray-400 text-sm">No reviews yet</p>`,
      );
      return;
    }

    let html = "";

    reviews.forEach((r) => {
      html += `
        <div class="border rounded-lg p-3">

            <div class="flex justify-between">

                <p class="font-semibold">${r.reviewer_name}</p>

                <p class="text-yellow-500 text-sm">
                    ${"★".repeat(r.rating)}
                </p>

            </div>

            <p class="text-sm text-gray-600 mt-1">
                ${r.review}
            </p>

        </div>
        `;
    });

    $("#reviewContainer").html(html);
  }

  $(document).on("click", ".deleteBtn", function (e) {
    e.stopPropagation(); // prevents modal open / card click

    let id = $(this).data("delete-id");
    DeleteHotel(id);

    console.log(`delete trigger for: ${id}`);
  });

  $(document).on("click", ".deleteRoomBtn", function (e) {
    e.stopPropagation(); // prevents modal open / card click

    let id = $(this).data("delete-id");
    let hotelID = $(this).data("hotel-id");
    DeleteRoom(id, hotelID);

    console.log(`delete trigger for: ${id}`);
  });

  async function DeleteRoom(roomID, hotelID) {
    const response = await apiCall({
      mode: "DELETE",
      isJson: true,
      payload: {
        roomID: roomID,
      },
      url: `/api/hotels/room/delete/${roomID}`,
      button: document.getElementById("proceedBtn"),
    });

    if (!response.success) {
      showMessage({
        status: "error",
        title: "Error Removing Room",
        message:
          "There is some error removing hotel. Please contact system administrator",
      });
      return;
    }

    showMessage({
      status: "success",
      title: "Room Removed!",
    });
    renderRooms(hotelID);
  }
  // =========================
  // API CALL
  // =========================
  async function postData(formData) {
    const response = await apiCall({
      mode: "POST",
      isJson: false,
      payload: formData,
      url: "/api/hotels/complete",
      button: document.getElementById("proceedBtn"),
    });

    if (!response.success) {
      showMessage({
        status: "error",
        title: "Error Saving Hotel",
        message:
          "There is some error saving your information. Please contact system administrator",
      });
      return;
    }

    showMessage({
      status: "success",
      title: "Hotel Saved!",
    });
    clearInputs();
    closemodals();
    loadHotels();
    console.log(response);
  }

  async function DeleteHotel(id) {
    const response = await apiCall({
      mode: "DELETE",
      isJson: true,
      payload: {
        id: id,
      },
      url: `/api/hotels/delete/${id}`,
      button: document.getElementById("proceedBtn"),
    });

    if (!response.success) {
      showMessage({
        status: "error",
        title: "Error Removing Hotel",
        message:
          "There is some error removing hotel. Please contact system administrator",
      });
      return;
    }

    showMessage({
      status: "success",
      title: "Hotel Removed!",
    });
    loadHotels();
  }
};
