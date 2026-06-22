<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-header>
    Hotels
</x-header>

<body
    class="bg-olive-50 text-gray-800 dark:bg-dark_bg dark:text-gray-300 font-sans antialiased selection:bg-olive-200 selection:text-olive-900">
    <x-navigator />

    <!-- Featured Hotels -->
    <section class="py-24  bg-olive-500">

        <div class="max-w-7xl mx-auto px-6">

            <!-- Section Header -->
            <div class="text-center mb-20 text-white">

                <span
                    class="inline-flex items-center bg-olive-100 text-olive-700 px-4 py-2 rounded-full text-sm font-medium">
                    Featured Hotels
                </span>

                <h2 class="mt-6 text-4xl lg:text-6xl font-bold">
                    Accredited Hotels
                </h2>

                <p class="mt-6 max-w-2xl mx-auto  text-lg">
                    Discover exceptional stays selected for their location,
                    comfort, hospitality, and unforgettable guest experiences.
                </p>

            </div>

            <!-- Hotels Inject Here -->
            <div id="featured-hotels" class="space-y-5">
            </div>

            <!-- View All -->
            <div class="text-center mt-24">

                <a href="/hotels"
                    class="inline-flex items-center border-2 border-olive-500 text-olive-600 hover:bg-olive-500 hover:text-white px-8 py-4 rounded-xl font-semibold transition">
                    View All Hotels
                </a>

            </div>

        </div>

    </section>
    <x-footer />
    <script>
        document.addEventListener("DOMContentLoaded", async () => {

            async function getHotels() {

                const res = await apiCall({
                    mode: "GET",
                    url: "/api/allHotels",
                    isJson: true,
                });
                return res;

            }
            renderHotels();

            function getStartingPrices(hotel) {

                let lowestOriginal = null;
                let lowestDiscounted = null;

                hotel.rooms.forEach(room => {
                    room.prices.forEach(priceData => {

                        const original = parseFloat(priceData.price);

                        const discounted = priceData.discounted_price ?
                            parseFloat(priceData.discounted_price) :
                            null;

                        // lowest original
                        if (!isNaN(original)) {
                            if (lowestOriginal === null || original < lowestOriginal) {
                                lowestOriginal = original;
                            }
                        }

                        // lowest discounted (only valid values)
                        if (!isNaN(discounted) && discounted !== null) {
                            if (lowestDiscounted === null || discounted < lowestDiscounted) {
                                lowestDiscounted = discounted;
                            }
                        }
                    });
                });

                return {
                    original: lowestOriginal,
                    discounted: lowestDiscounted
                };
            }

            function renderSlides(photos, hotelName) {
                return photos.map(photo => `
<div class="swiper-slide">
    <img src="${photo}" alt="${hotelName}" class="w-full h-[250px] sm:h-[320px] md:h-[400px] lg:h-[500px] object-cover">
</div>
    `).join('');
            }
            async function renderHotels() {

                const hotelContainer = document.getElementById("featured-hotels");
                const hotels = await getHotels();
                const featured = hotels.data;
                console.log(hotels);

                hotelContainer.innerHTML = "";
                featured.forEach((hotel, index) => {

                    const photos = hotel.photos?.length ?
                        hotel.photos : ['/images/no-image.jpg'];

                    const startingPrice = getStartingPrices(hotel);

                    const layout = `
<div class="w-full ">

    <div class="w-full mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden">

        <div class="flex flex-col items-center text-center p-8 gap-6">

            <!-- Logo -->
            <img src="${hotel.logo}" alt="LOGO" class="w-24 h-auto">

            <!-- Hotel Info -->
            <div class="space-y-3">
                <h1 class="text-5xl font-light text-zinc-800">
                    ${hotel.name}
                </h1>

                <p class="text-zinc-500">
                    ${hotel.city}, ${hotel.province}
                </p>

                <p class="text-zinc-500 leading-relaxed">
                    ${hotel.description ?? 'Experience comfort and luxury with exclusive member pricing and premium accommodations.'}
                </p>
            </div>

            <!-- Divider -->
            <div class="w-24 h-px bg-zinc-200"></div>

            <!-- Price Section -->
            <div class="space-y-4">

                <div>
                    <p class="text-sm uppercase tracking-widest text-zinc-400">
                        Original Starting Price
                    </p>

                    <p class="text-xl text-zinc-500 line-through">
                        ${startingPrice ? '₱' + Number(startingPrice.original).toLocaleString() : 'Contact Us'}
                    </p>
                </div>

                <div>
                    <p class="text-sm uppercase tracking-widest text-olive-600">
                        MYPS Exclusive Starting Price
                    </p>

                    <p class="text-6xl font-bold text-olive-700">
                        ${startingPrice ? '₱' + Number(startingPrice.discounted).toLocaleString() : 'Contact Us'}
                    </p>

                    <span class="inline-block mt-3 bg-red-100 text-red-600 px-4 py-1 rounded-full text-sm font-semibold">
                        Save 31%
                    </span>
                </div>

            </div>

            <!-- Book Button -->
            <a href="/hotel?id=${hotel.id}"
                class="py-5 px-10 rounded-lg bg-olive-600 hover:bg-olive-700 text-white font-semibold transition duration-300">
                Book Now
            </a>

            <!-- Swiper -->
            <div class="hotel-image relative w-full">

                <div class="swiper hotel-swiper-${hotel.id} w-full rounded-2xl lg:rounded-xl overflow-hidden shadow-xl">

                    <div class="swiper-wrapper w-full">
                        ${renderSlides(photos, hotel.name)}
                    </div>

                    <div class="swiper-pagination"></div>
                </div>

                <!-- Prev -->
                <button class="hotel-prev-${hotel.id} absolute left-4 top-1/2 -translate-y-1/2 z-10 bg-white/70 hover:bg-white shadow-lg rounded-full w-10 h-10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- Next -->
                <button class="hotel-next-${hotel.id} absolute right-4 top-1/2 -translate-y-1/2 z-10 bg-white/70 hover:bg-white shadow-lg rounded-full w-10 h-10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5l7 7-7 7" />
                    </svg>
                </button>

            </div>

        </div>

    </div>

</div>
`;

                    hotelContainer.innerHTML += layout;

                });


                // Init Swipers AFTER DOM render
                featured.forEach(hotel => {

                    new Swiper(`.hotel-swiper-${hotel.id}`, {
                        loop: true,
                        autoplay: {
                            delay: 4000
                        },
                        pagination: {
                            el: `.hotel-swiper-${hotel.id} .swiper-pagination`,
                            clickable: true
                        }
                    });

                });

            }
        });
    </script>
</body>
