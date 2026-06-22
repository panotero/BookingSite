<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-header>
    Home
</x-header>

<body
    class="bg-olive-50 text-gray-800 dark:bg-dark_bg dark:text-gray-300 font-sans antialiased selection:bg-olive-200 selection:text-olive-900">

    <x-navigator />

    <!-- Hero Section -->
    <section class="bg-cream min-h-screen flex items-center">

        <div class="max-w-7xl mx-auto px-6 py-20">

            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left -->
                <div>

                    <span
                        class="inline-flex items-center bg-paper text-olive-700 px-4 py-2 rounded-full text-sm font-medium mb-6">

                    </span>

                    <h1 class="text-5xl lg:text-5xl font-bold text-olive-700 leading-tight">
                        Exclusive of MY PalauSport guests!
                    </h1>
                    <span class="text-3xl block text-olive-500">
                        Discover Great Hotels & Resorts
                    </span>

                    <p class="mt-6 text-gray-600 max-w-xl text-lg">
                        Enjoy complimentary hotel booking assistance when you reserve
                        your hotel stay at any of these carefully selected hotel in Puerto
                        Princesa through MY PalauSport.

                        As our valued guest for the upcoming Tubbataha 2027 liveaboard
                        expedition, you'll have access to exclusive dicounted hotel rates
                        available through our booking service.

                        This personalized service is provided completely free of charge,
                        ensuring your experience with us is nothing less than seamless,
                        stress-free and professionally managed-- from the moment you
                        arrive at Puerto Princesa until you depart to head back home,
                        we will take care of you.

                    </p>

                    <!-- Search Form -->
                    <form action="/search" method="GET"
                        class="mt-8 bg-white rounded-3xl shadow-lg border border-paper p-5 hidden">

                        <div class="grid md:grid-cols-3 gap-4">

                            <!-- Location -->
                            <div>

                                <label class="block text-sm font-medium text-olive-700 mb-2">
                                    Destination
                                </label>

                                <input type="text" name="location" placeholder="Where are you going?"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-olive-400">

                            </div>

                            <!-- Check In -->
                            <div>

                                <label class="block text-sm font-medium text-olive-700 mb-2">
                                    Check In
                                </label>

                                <input type="date" name="from"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-olive-400">

                            </div>

                            <!-- Check Out -->
                            <div>

                                <label class="block text-sm font-medium text-olive-700 mb-2">
                                    Check Out
                                </label>

                                <input type="date" name="to"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-olive-400">

                            </div>

                        </div>

                        <div class="flex flex-wrap gap-4 mt-5">

                            <button type="submit"
                                class="bg-olive-500 hover:bg-olive-600 text-white px-8 py-4 rounded-xl font-semibold transition">

                                Search Hotels

                            </button>

                            <a href="#featured"
                                class="border-2 border-olive-500 text-olive-600 hover:bg-olive-500 hover:text-white px-8 py-4 rounded-xl font-semibold transition">

                                Explore Destinations

                            </a>

                        </div>

                    </form>

                    <!-- Stats -->
                    <div class="flex flex-wrap gap-8 mt-10  hidden">

                        <div>
                            <h3 class="text-2xl font-bold text-olive-700">500+</h3>
                            <p class="text-gray-500 text-sm">Hotels Listed</p>
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-olive-700">100+</h3>
                            <p class="text-gray-500 text-sm">Destinations</p>
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-olive-700">10k+</h3>
                            <p class="text-gray-500 text-sm">Happy Travelers</p>
                        </div>

                    </div>

                </div>

                <!-- Right -->
                <div class="relative">

                    <div class="absolute -top-6 -left-6 w-32 h-32 bg-blue-700/50 rounded-full opacity-70">
                    </div>

                    <div class="absolute -bottom-6 -right-6 w-40 h-40 bg-blue-200 rounded-full opacity-60">
                    </div>

                    <img src="/images/MYPSLOGO.png"
                        class="relative rounded-[32px] shadow-xl w-full h-[500px] object-cover">

                </div>

            </div>

        </div>

    </section>
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
    <!-- Why Book With Us -->
    <section class="py-24 bg-cream">

        <div class="max-w-7xl mx-auto px-6">

            <!-- Header -->
            <div class="text-center max-w-3xl mx-auto mb-20">

                <span
                    class="inline-flex items-center bg-paper text-olive-700 px-4 py-2 rounded-full text-sm font-medium">
                    Why Choose Us
                </span>

                <h2 class="mt-6 text-4xl lg:text-6xl font-bold text-olive-700">
                    Why Book With Us
                </h2>

                <p class="mt-6 text-lg text-gray-600">
                    We make finding and booking your perfect stay simple, secure,
                    and stress-free.
                </p>

            </div>

            <!-- Features -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

                <!-- Feature -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-paper">

                    <div class="w-14 h-14 rounded-2xl bg-olive-100 flex items-center justify-center mb-6">

                        <svg class="w-7 h-7 text-olive-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z" />

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 2C7 2 3 6 3 11c0 6 9 11 9 11s9-5 9-11c0-5-4-9-9-9z" />

                        </svg>

                    </div>

                    <h3 class="text-xl font-bold text-olive-700">
                        Curated Destinations
                    </h3>

                    <p class="mt-4 text-gray-600">
                        Carefully selected hotels and resorts in top destinations,
                        ensuring quality stays and memorable experiences.
                    </p>

                </div>

                <!-- Feature -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-paper">

                    <div class="w-14 h-14 rounded-2xl bg-olive-100 flex items-center justify-center mb-6">

                        <svg class="w-7 h-7 text-olive-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-4 0-7 2-7 5v4h14v-4c0-3-3-5-7-5z" />

                            <circle cx="12" cy="5" r="3" stroke-width="2"></circle>

                        </svg>

                    </div>

                    <h3 class="text-xl font-bold text-olive-700">
                        Trusted Reviews
                    </h3>

                    <p class="mt-4 text-gray-600">
                        Read authentic guest feedback and ratings to help you make
                        informed booking decisions.
                    </p>

                </div>

                <!-- Feature -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-paper">

                    <div class="w-14 h-14 rounded-2xl bg-olive-100 flex items-center justify-center mb-6">

                        <svg class="w-7 h-7 text-olive-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />

                            <circle cx="12" cy="12" r="9" stroke-width="2"></circle>

                        </svg>

                    </div>

                    <h3 class="text-xl font-bold text-olive-700">
                        Instant Booking
                    </h3>

                    <p class="mt-4 text-gray-600">
                        Quickly check availability and secure your reservation in
                        just a few simple steps.
                    </p>

                </div>

                <!-- Feature -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-paper">

                    <div class="w-14 h-14 rounded-2xl bg-olive-100 flex items-center justify-center mb-6">

                        <svg class="w-7 h-7 text-olive-700" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4" />

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 2l7 4v6c0 5-3 9-7 10-4-1-7-5-7-10V6l7-4z" />

                        </svg>

                    </div>

                    <h3 class="text-xl font-bold text-olive-700">
                        Secure Reservations
                    </h3>

                    <p class="mt-4 text-gray-600">
                        Your booking details are protected through secure systems,
                        giving you peace of mind throughout the process.
                    </p>

                </div>

            </div>

        </div>

    </section>

    <x-footer />

    <script>
        $('#menu-btn').on('click', function() {
            $('#mobile-menu').toggleClass('hidden');
        });

        document.addEventListener("DOMContentLoaded", async function() {

            async function getHotels() {

                const res = await apiCall({
                    mode: "GET",
                    url: "/api/allHotels",
                    isJson: true,
                });
                return res;

            }
            renderHotels(5);

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

            async function renderHotels(count = 5) {

                const hotelContainer = document.getElementById("featured-hotels");
                const hotels = await getHotels();
                const featured = hotels.data.slice(0, count);
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

</html>
