<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-header>
    Hotel
</x-header>

<body
    class="bg-olive-50 text-gray-800 dark:bg-dark_bg dark:text-gray-300 font-sans antialiased selection:bg-olive-200 selection:text-olive-900">
    <x-navigator />
    <!-- HOTEL INFO SECTION -->
    <section id="hotel-info" class="bg-cream py-10 md:py-14 lg:py-16">

        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-start">

                <!-- Gallery -->
                <div>

                    <div class="swiper hotel-gallery rounded-2xl lg:rounded-[32px] overflow-hidden shadow-xl">

                        <div class="swiper-wrapper" id="hotel-gallery-wrapper">
                            <!-- JS inject slides here -->
                        </div>

                        <div class="swiper-pagination"></div>

                    </div>

                </div>

                <!-- Info -->
                <div class="flex flex-col">

                    <!-- Rating -->
                    <div class="flex flex-wrap items-center gap-2 mb-4">

                        <div id="hotel-rating-stars" class="text-yellow-500 text-base sm:text-lg md:text-xl">
                            ★★★★★
                        </div>

                        <span id="hotel-review-count" class="text-sm md:text-base text-gray-500">
                            0 Reviews
                        </span>

                    </div>

                    <!-- Name -->
                    <h1 id="hotel-name"
                        class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-olive-700 break-words leading-tight">
                    </h1>

                    <!-- Location -->
                    <p id="hotel-location" class="text-sm md:text-base text-gray-500 mt-3">
                    </p>

                    <!-- Description -->
                    <p id="hotel-description" class="mt-6 lg:mt-8 text-base md:text-lg text-gray-600 leading-relaxed">
                    </p>

                    <!-- CTA -->
                    <div class="mt-8 lg:mt-10">

                        <a id="hotel-book-btn" target="_blank" rel="noopener"
                            class="w-full sm:w-auto justify-center bg-olive-500 hover:bg-olive-600 text-white px-8 py-4 rounded-xl font-semibold inline-flex transition">
                            Book Now
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ROOMS SECTION -->
    <section class="py-12 md:py-16 lg:py-24 bg-paper">

        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            <!-- Header -->
            <div class="mb-8 md:mb-12">

                <h2 class="text-3xl md:text-4xl font-bold text-olive-700">
                    Available Rooms
                </h2>

                <p class="text-gray-600 mt-3">
                    Choose the room that best fits your stay.
                </p>

            </div>

            <!-- Scroll Container -->
            <div id="rooms-container"
                class="
                flex
                gap-4 md:gap-6
                overflow-x-auto
                pb-4 md:pb-6
                snap-x
                snap-mandatory
                scroll-smooth
                scrollbar-hide
                -mx-4 px-4 sm:mx-0 sm:px-0
            ">

                <!-- JS inject room cards here -->

                <div id="rooms-empty" class="text-gray-500 hidden">
                    No rooms available.
                </div>

            </div>

        </div>

    </section>


    <x-footer />

    <script>
        document.addEventListener("DOMContentLoaded", async () => {

            const hotelID = new URLSearchParams(window.location.search).get("id");

            if (!hotelID) {
                console.error("Hotel ID not found.");
                return;
            }

            const hotel = await getHotel();

            if (!hotel || !hotel.data) {
                console.error("Hotel not found.");
                return;
            }

            renderHotel(hotel.data);

            async function getHotel() {

                const res = await apiCall({
                    mode: "GET",
                    url: `/api/hotel/${hotelID}`,
                    isJson: true,
                });

                return res;
            }

            function renderHotel(hotel) {

                // HOTEL INFO

                document.getElementById("hotel-name").textContent =
                    hotel.name;

                document.getElementById("hotel-location").textContent =
                    `${hotel.city}, ${hotel.province}`;

                document.getElementById("hotel-description").textContent =
                    hotel.description;

                document.getElementById("hotel-review-count").textContent =
                    `${hotel.reviews?.length ?? 0} Reviews`;

                const bookButton =
                    document.getElementById("hotel-book-btn");

                if (hotel.forms?.form_url) {

                    bookButton.href = hotel.forms.form_url;
                    bookButton.target = "_blank";

                } else {

                    bookButton.href = "#";
                    bookButton.classList.add(
                        "opacity-50",
                        "pointer-events-none"
                    );

                }

                // GALLERY

                const gallery =
                    document.getElementById(
                        "hotel-gallery-wrapper"
                    );

                gallery.innerHTML =
                    hotel.photos?.length ?
                    hotel.photos.map(photo => `
                    <div class="swiper-slide">
                        <img
                            src="${photo}"
                            alt="${hotel.name}"
                            class="w-full h-[250px] sm:h-[350px] lg:h-[550px] object-cover">
                    </div>
                `).join("") :
                    `
                    <div class="swiper-slide">
                        <img
                            src="/images/no-image.jpg"
                            class="w-full h-[250px] sm:h-[350px] lg:h-[550px] object-cover">
                    </div>
                `;

                // ROOMS

                const roomsContainer =
                    document.getElementById("rooms-container");

                roomsContainer.innerHTML = "";

                hotel.rooms.forEach(room => {

                    const pricing =
                        room.prices?.[0] ?? null;

                    const originalPrice =
                        pricing?.price ?? null;

                    const discountedPrice =
                        pricing?.discounted_price ?? null;

                    roomsContainer.innerHTML += `

<div class="
    w-3/4
    bg-white
    rounded-2xl lg:rounded-[24px]
    overflow-hidden
    shadow-lg
    border border-gray-100
    flex-shrink-0
    snap-start">

    <img
        src="${room.photos?.[0] ?? '/images/no-image.jpg'}"
        class="w-full h-[180px] sm:h-[220px] object-cover">

    <div class="p-4 sm:p-6">

        <h3 class="text-xl sm:text-2xl font-bold text-olive-700 leading-tight">
            ${room.room_name}
        </h3>

        <p class="text-gray-600 mt-3 text-sm sm:text-base line-clamp-3">
            ${room.description}
        </p>

        <div class="flex flex-wrap gap-3 sm:gap-4 mt-5 text-sm text-gray-500">

            <span>
                ${room.guest_capacity} Guests
            </span>

            <span>
                ${room.bed_count} Beds
            </span>

            <span>
                ${room.room_area}
            </span>

        </div>

        <div class="mt-6">

            ${
                discountedPrice &&
                Number(discountedPrice) > 0
                    ? `
                                                                            <div class="text-gray-400 line-through text-sm sm:text-lg">
                                                                                ₱${Number(originalPrice).toLocaleString()}
                                                                            </div>

                                                                            <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-olive-700">
                                                                                ₱${Number(discountedPrice).toLocaleString()}
                                                                            </div>
                                                                        `
                    : `
                                                                            <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-olive-700">
                                                                                ₱${Number(originalPrice).toLocaleString()}
                                                                            </div>
                                                                        `
            }

        </div>

        ${
            hotel.forms?.form_url
                ? `
                                                                        <a
                                                                            href="${hotel.forms.form_url}"
                                                                            target="_blank"
                                                                            class="mt-6 w-full sm:w-auto justify-center inline-flex bg-olive-500 hover:bg-olive-600 text-white px-6 py-3 rounded-xl font-semibold transition">
                                                                            Book Now
                                                                        </a>
                                                                    `
                : ''
        }

    </div>

</div>

`;
                });

                // SWIPER

                new Swiper(".hotel-gallery", {
                    loop: true,
                    autoplay: {
                        delay: 4000,
                    },
                    pagination: {
                        el: ".hotel-gallery .swiper-pagination",
                        clickable: true,
                    },
                });
            }

            const roomsContainer = document.getElementById("rooms-container");

            roomsContainer.addEventListener("wheel", (e) => {

                const delta = e.deltaY;

                const maxScrollLeft = roomsContainer.scrollWidth - roomsContainer.clientWidth;
                const currentScroll = roomsContainer.scrollLeft;

                const atStart = currentScroll <= 0;
                const atEnd = currentScroll >= maxScrollLeft;

                const scrollingRight = delta > 0;
                const scrollingLeft = delta < 0;

                // If we can still scroll horizontally, prevent page scroll
                if (
                    (scrollingLeft && !atStart) ||
                    (scrollingRight && !atEnd)
                ) {
                    e.preventDefault();
                    roomsContainer.scrollLeft += delta;
                }

            }, {
                passive: false
            });
        });
    </script>
</body>

</html>
```
