window.initHotelFunction = function initHotelFunction() {
  document
    .getElementById("openHotelModal")
    .addEventListener("click", function () {
      initModal({
        modalId: "HotelModal",
      });
    });

  let roomIndex = 0;
  $("#addRoomNewBtn").on("click", function () {
    initModal({
      modalId: "RoomModal",
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
                        placeholder="Deluxe Ocean View" required>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">
                        Room Area
                    </label>

                    <input type="text"
                        class="room_area w-full border rounded-xl px-4 py-3 mt-1"
                        placeholder="45 sqm" required>
                </div>

            </div>



            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="text-sm font-medium text-gray-700">
                        Guest Capacity
                    </label>

                    <input type="number"
                        class="guest_capacity w-full border rounded-xl px-4 py-3 mt-1"
                        placeholder="4" required>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">
                        Bed Count
                    </label >

                    <input type="number"
                        class="bed_count w-full border rounded-xl px-4 py-3 mt-1"
                        placeholder="2" required>
                </div>

            </div>



            <div>
                <label class="text-sm font-medium text-gray-700">
                    Room Description
                </label>

                <textarea rows="3"
                    class="room_description w-full border rounded-xl px-4 py-3 mt-1"
                    placeholder="Ocean facing room" required></textarea>
            </div>



            <div>
                <label class="text-sm font-medium text-gray-700">
                    Room Photos
                </label>

                <input type="file"
                    multiple
                    class="room_photos w-full border rounded-xl px-4 py-3 mt-1" required>
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
                    placeholder="12000" required>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">
                    Discounted Price
                </label>

                <input type="number"
                    class="discounted_price w-full border rounded-xl px-4 py-3 mt-1"
                    placeholder="9999" required>
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
    let proceed = true;

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
          const price = $(this).find(".price").val();
          const dprice = $(this).find(".discounted_price").val();
          //check  if the original price is greater that discounted price.
          if (price < dprice) {
            //show message

            $(this).find(".discounted_price").addClass("border-red-500");
            showMessage({
              status: "error",
              title: "Error Adding Room",
              message:
                "Discounted price should be less than the original price.",
            });
            proceed = false;
            return;
          }
          formData.append(
            `rooms[${roomIndex}][prices][${priceIndex}][price]`,
            price,
          );

          formData.append(
            `rooms[${roomIndex}][prices][${priceIndex}][discounted_price]`,
            dprice,
          );
        });
    });

    if (!proceed) return;
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
    document.getElementById("RoomModal").classList.add("hidden");
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
    formData.append(
      "hotel[external_form_url]",
      $("#hotel_external_form_url").val(),
    );

    // =========================
    // HOTEL PHOTOS
    // =========================

    let hotelPhotos = $("#hotel_photos")[0].files;
    let hotelLogo = $("#hotel_logo")[0].files[0];
    let proceed = true;
    for (let i = 0; i < hotelPhotos.length; i++) {
      formData.append("hotel[photos][]", hotelPhotos[i]);
    }

    formData.append("hotel[logo]", hotelLogo);

    // =========================
    // ROOMS
    // =========================

    const roomCards = document.querySelectorAll(".room-card");
    roomCards.forEach((roomCard, roomIndex) => {
      formData.append(
        `rooms[${roomIndex}][room_name]`,
        roomCard.querySelector(".room_name").value,
      );

      formData.append(
        `rooms[${roomIndex}][description]`,
        roomCard.querySelector(".room_description").value,
      );

      formData.append(
        `rooms[${roomIndex}][guest_capacity]`,
        roomCard.querySelector(".guest_capacity").value,
      );

      formData.append(
        `rooms[${roomIndex}][bed_count]`,
        roomCard.querySelector(".bed_count").value,
      );

      formData.append(
        `rooms[${roomIndex}][room_area]`,
        roomCard.querySelector(".room_area").value,
      );

      // =========================
      // ROOM PHOTOS
      // =========================

      const roomPhotos = roomCard.querySelector(".room_photos").files;

      for (let p = 0; p < roomPhotos.length; p++) {
        formData.append(`rooms[${roomIndex}][photos][]`, roomPhotos[p]);
      }

      // =========================
      // ROOM PRICES
      // =========================

      roomCard
        .querySelectorAll(".price-card")
        .forEach((priceCard, priceIndex) => {
          const price = priceCard.querySelector(".price").value;
          const dprice = priceCard.querySelector(".discounted_price").value;

          // check if discounted price is greater than original price
          if (Number(price) < Number(dprice)) {
            priceCard
              .querySelector(".discounted_price")
              .classList.add("border-red-500");

            showMessage({
              status: "error",
              title: "Error Adding Room",
              message:
                "Discounted price should be less than the original price.",
            });

            proceed = false;
            return;
          }

          formData.append(
            `rooms[${roomIndex}][prices][${priceIndex}][price]`,
            price,
          );

          formData.append(
            `rooms[${roomIndex}][prices][${priceIndex}][discounted_price]`,
            dprice,
          );
        });
    });
    if (!proceed) return;
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

    const delbtn = document.querySelectorAll(".deleteBtn");
    delbtn.forEach((deleteButton) => {
      deleteButton.addEventListener("click", function (e) {
        e.stopPropagation();
        const deleteId = this.dataset.deleteId;

        DeleteHotel(deleteId);
      });
    });
  }
  $("#editHotelBtn").on("click", function (e) {
    const editsvg = `
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487a2.25 2.25 0 113.182 3.182L8.25 19.463 3 21l1.537-5.25L16.862 4.487z" />
                    </svg>`;
    const cancelsvg = `<svg xmlns="http://www.w3.org/2000/svg"
         fill="none"
         viewBox="0 0 24 24"
         stroke-width="1.5"
         stroke="currentColor"
         class="w-6 h-auto aspect-square text-white bg-red-600 rounded-full">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M6 18L18 6M6 6l12 12" />
    </svg>`;

    const editBtn = $(this);
    if (editBtn.hasClass("cancel")) {
      editBtn.html(editsvg);
      editBtn.removeClass("cancel");
      enableEditing(false);
    } else {
      editBtn.html(cancelsvg);
      editBtn.addClass("cancel");
      enableEditing(true);
    }
    function enableEditing(rule = false) {
      const form = document.getElementById("modalInfoForm");
      const inputs = form.querySelectorAll("input, textarea, select");

      inputs.forEach((input) => {
        if (rule) {
          input.removeAttribute("disabled");
          input.classList.remove("bg-gray-300");
        } else {
          input.setAttribute("disabled", true);
          input.classList.add("bg-gray-300");
        }
      });
    }
  });
  $(document).on("click", ".hotel-card", async function (e) {
    if ($(e.target).hasClass("deleteHotelBtn")) return;

    let id = $(this).data("id");
    //apicall for get hotel  info
    document.getElementById("AddHotelPhotoModal").dataset.hotelId = id;
    renderHotelInfo(id);
    initModal({
      modalId: "HotelInfoModal",
    });
    $("#addRoomForm").attr("data-hotel-id", id);
  });

  document
    .getElementById("submithotelphoto")
    .addEventListener("click", async function (e) {
      const input = document.getElementById("hotelPhotoInput");
      const hotelId =
        document.getElementById("AddHotelPhotoModal").dataset.hotelId;
      const formData = new FormData();

      formData.append("hotelID", hotelId);

      const files = input.files;

      for (const file of files) {
        formData.append("photos[]", file);
      }

      console.log("HOTEL PHOTOS");

      for (const [key, value] of formData.entries()) {
        console.log(key, value);
      }

      // await apiCall(...)

      const response = await apiCall({
        mode: "POST",
        isJson: false,
        payload: formData,
        url: "/api/hotels/photo",
        button: this,
      });

      if (!response.success) {
        showMessage({
          status: "error",
          title: "Error Adding Photo",
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
      closemodals("AddHotelPhotoModal");

      document.getElementById("hotelPhotoInfo").innerHTML = "";
      renderHotelInfo(hotelId);
    });

  async function renderHotelInfo(hotelId) {
    const hotels = await apiCall({
      mode: "GET",
      url: `/api/hotels/info/${hotelId}`,
      isJson: true,
    });

    if (!hotels.success) {
      showMessage({
        status: "error",
        title: "Error Fetching Information",
        message:
          "There is some error fetching your information. Please contact system administrator",
      });
      return;
    }

    const hotel = hotels.data;

    $("#modalHotelTitle").text(hotel.name);
    $("#modalHotelName").val(hotel.name ?? "");
    $("#modalHotelDesc").val(hotel.description ?? "");
    $("#modalHotelAddress").val(`${hotel.full_address}`);
    $("#modalHotelExteralForm").val(`${hotel.forms?.form_url || "No Url"}`);

    renderRooms(hotelId);
    renderReviews(hotel.reviews);
    renderPhotoGallery({
      container: document.getElementById("hotelPhotoContainer"),
      photos: hotel.photos,
      modelId: hotelId,
      deleteUrl: "/api/hotels/photo/",
      onDeleteSuccess: () => renderHotelInfo(hotelId, hotel),
    });
  }

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
    if (!rooms.success) {
      $("#roomContainer").html(
        '<div class="col-span-2 p-5 w-full text-zinc-500 text-center font-semibold"> No available rooms for this hotel</div>',
      );
      return;
    }

    rooms.data.forEach((room) => {
      let img = room.photos?.[0] ?? "https://via.placeholder.com/300";
      let price = room.prices?.[0];

      let priceText = price ? `₱${price.price}` : "No price";
      let discountedPrice = price
        ? `₱${price.discounted_price}`
        : "No Discounted Price";

      html += `
        <div class="relative border rounded-xl overflow-hidden shadow-sm roominfo-card cursor-pointer" data-room-id="${room.id}">

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

    const deleteRoomButtons = document.querySelectorAll(".deleteRoomBtn");
    deleteRoomButtons.forEach((deletebtn) => {
      deletebtn.addEventListener("click", function (e) {
        e.stopPropagation();
        const id = this.dataset.deleteId;
        const hotelID = this.dataset.hotelId;
        DeleteRoom(id, hotelID);
      });
    });
    const roomCard = document.querySelectorAll(".roominfo-card");
    roomCard.forEach((card) => {
      card.addEventListener("click", function (e) {
        e.stopPropagation();
        const roomId = this.dataset.roomId;
        //render room info first
        LoadRoomInfo(roomId);

        //then call the openmodal

        initModal({
          modalId: "RoomInfoModal",
        });
      });
    });
  }

  document
    .getElementById("addHotelPhotoBtn")
    .addEventListener("click", function () {
      initModal({
        modalId: "AddHotelPhotoModal",
      });
    });
  document
    .getElementById("addRoomPhotoBtn")
    .addEventListener("click", function () {
      initModal({
        modalId: "AddRoomPhotoModal",
      });
    });

  document
    .getElementById("roomPhotoInput")
    .addEventListener("change", function () {
      const info = document.getElementById("roomPhotoInfo");

      const files = Array.from(this.files);

      if (files.length === 0) {
        info.innerHTML = "";
        return;
      }

      let html = `
        <p class="font-medium text-gray-800">
            ${files.length} file(s) selected
        </p>
        <ul class="list-disc list-inside text-gray-600 text-xs space-y-1">
    `;

      files.forEach((file) => {
        html += `<li>${file.name}</li>`;
      });

      html += `</ul>`;

      info.innerHTML = html;
    });

  document
    .getElementById("hotelPhotoInput")
    .addEventListener("change", function () {
      const info = document.getElementById("hotelPhotoInfo");

      const files = Array.from(this.files);

      if (files.length === 0) {
        info.innerHTML = "";
        return;
      }

      let html = `
        <p class="font-medium text-gray-800">
            ${files.length} file(s) selected
        </p>
        <ul class="list-disc list-inside text-gray-600 text-xs space-y-1">
    `;

      files.forEach((file) => {
        html += `<li>${file.name}</li>`;
      });

      html += `</ul>`;

      info.innerHTML = html;
    });

  async function LoadRoomInfo(roomId) {
    const room = await apiCall({
      mode: "GET",
      url: `/api/room/${roomId}`,
      isJson: true,
    });
    document.getElementById("AddRoomPhotoModal").dataset.roomId = roomId;

    if (!room.success) {
      showMessage({
        status: "error",
        title: "Error Saving Options",
        message:
          "There is some error saving your information. Please contact system administrator",
      });
      return;
    }
    const roomData = room.data;
    //initialize value of all fields
    //select the form
    const roomInfoForm = document.getElementById("RoomInfoForm");
    const inputs = {
      roomName: roomInfoForm.querySelector(".room_name"),
      roomArea: roomInfoForm.querySelector(".room_area"),
      guestCapacity: roomInfoForm.querySelector(".guest_capacity"),
      bedCount: roomInfoForm.querySelector(".bed_count"),
      roomDescription: roomInfoForm.querySelector(".room_description"),
    };

    const mapping = {
      roomName: "room_name",
      roomArea: "room_area",
      guestCapacity: "guest_capacity",
      bedCount: "bed_count",
      roomDescription: "description",
    };

    Object.entries(mapping).forEach(([inputKey, dataKey]) => {
      inputs[inputKey].value = roomData[dataKey] ?? "";
    });

    //rennder photo cards
    renderPhotoGallery({
      container: document.getElementById("roomPhotoContainer"),
      photos: roomData.photos,
      modelId: roomId,
      deleteUrl: "/api/room/photo/",
      onDeleteSuccess: () => LoadRoomInfo(roomId),
    });
  }

  document
    .getElementById("submitroomphoto")
    .addEventListener("click", async function (e) {
      e.preventDefault();

      const input = document.getElementById("roomPhotoInput");
      const formData = new FormData();
      const roomId =
        document.getElementById("AddRoomPhotoModal").dataset.roomId;
      formData.append("roomID", roomId);

      const files = input.files;

      for (const file of files) {
        formData.append("photos[]", file);
      }

      console.log("ROOM PHOTOS");

      for (const [key, value] of formData.entries()) {
        console.log(key, value);
      }

      // await apiCall(...)

      const response = await apiCall({
        mode: "POST",
        isJson: false,
        payload: formData,
        url: "/api/room/photo",
        button: this,
      });

      if (!response.success) {
        showMessage({
          status: "error",
          title: "Error Adding Photo",
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
      closemodals("AddRoomPhotoModal");
      document.getElementById("roomPhotoInfo").innerHTML = "";
      LoadRoomInfo(roomId);
    });

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
