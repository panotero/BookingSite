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
                        Find Your Perfect Stay
                    </span>

                    <h1 class="text-5xl lg:text-7xl font-bold text-olive-700 leading-tight">
                        Discover Exceptional
                        <span class="block text-olive-500">
                            Hotels & Resorts
                        </span>
                    </h1>

                    <p class="mt-6 text-gray-600 max-w-xl text-lg">
                        Browse handpicked hotels, luxury resorts, beachfront escapes, and
                        unique stays. Compare prices, check availability, and book your next
                        unforgettable getaway with confidence.
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

                    <div class="absolute -top-6 -left-6 w-32 h-32 bg-paper rounded-full opacity-70">
                    </div>

                    <div class="absolute -bottom-6 -right-6 w-40 h-40 bg-olive-200 rounded-full opacity-60">
                    </div>

                    <img src="/images/hoteel2.jpeg"
                        class="relative rounded-[32px] shadow-xl w-full h-[500px] object-cover">

                </div>

            </div>

        </div>

    </section>
    <!-- Featured Hotels -->
    <section class="py-24 bg-paper">

        <div class="max-w-7xl mx-auto px-6">

            <!-- Section Header -->
            <div class="text-center mb-20">

                <span
                    class="inline-flex items-center bg-olive-100 text-olive-700 px-4 py-2 rounded-full text-sm font-medium">
                    Featured Collection
                </span>

                <h2 class="mt-6 text-4xl lg:text-6xl font-bold text-olive-700">
                    Handpicked Hotels
                </h2>

                <p class="mt-6 max-w-2xl mx-auto text-gray-600 text-lg">
                    Discover exceptional stays selected for their location,
                    comfort, hospitality, and unforgettable guest experiences.
                </p>

            </div>

            <!-- Hotels Inject Here -->
            <div id="featured-hotels" class="space-y-32">
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

    <!-- Footer -->
    <footer class="bg-dark_bg text-white py-12 mt-12 border-t border-white/10">
        <div class="max-w-screen-xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0 text-center md:text-left">
                <h5 class="font-bold text-xl tracking-wide">LUXESTAY</h5>
                <p class="text-olive-400 text-sm mt-1">© 2026 All rights reserved.</p>
            </div>
            <div class="flex space-x-6 text-sm text-olive-200">
                <a href="#" class="hover:text-white transition">Privacy</a>
                <a href="#" class="hover:text-white transition">Terms</a>
            </div>
        </div>
    </footer>


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

            function getStartingPrice(hotel) {
                let lowestPrice = null;

                hotel.rooms.forEach(room => {
                    room.prices.forEach(priceData => {

                        let price = parseFloat(
                            priceData.discounted_price &&
                            parseFloat(priceData.discounted_price) > 0 ?
                            priceData.discounted_price :
                            priceData.price
                        );

                        if (lowestPrice === null || price < lowestPrice) {
                            lowestPrice = price;
                        }
                    });
                });

                return lowestPrice;
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

                hotelContainer.innerHTML = "";

                featured.forEach((hotel, index) => {

                    const photos = hotel.photos?.length ?
                        hotel.photos : ['/images/no-image.jpg'];

                    const startingPrice = getStartingPrice(hotel);

                    const imageSection = `
<div class="hotel-image">
    <div class="swiper hotel-swiper-${hotel.id} rounded-2xl lg:rounded-xl overflow-hidden shadow-xl">
        <div class="swiper-wrapper">
            ${renderSlides(photos, hotel.name)}
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
`;


                    const contentSection = `
                <div class="hotel-content h-full flex flex-col justify-between">

                    <div class="flex items-center gap-2 mb-4">

                        <div class="text-yellow-500 text-xl">★★★★★</div>

                        <span class="text-gray-500">
                            ${hotel.reviews?.length ?? 0} Reviews
                        </span>

                    </div>
                    <div>

                    <h3 class="text-4xl font-bold text-olive-700">
                        ${hotel.name}
                    </h3>

                    <p class="text-gray-500 mt-2">
                        ${hotel.city}, ${hotel.province}
                    </p>


                    <p class="mt-6 text-gray-600 leading-relaxed">
                        ${hotel.description}
                    </p>
                    </div>

                    <blockquote class="mt-8 border-l-4 border-olive-500 pl-6 italic text-gray-600">
                        ${
                            hotel.reviews?.length
                                ? `"${hotel.reviews[0].review}"`
                                : `"A carefully selected hotel offering comfort and quality stay experience."`
                        }
                    </blockquote>

                    <div class="w-full md:flex lg:justify-between items-end gap-6 mt-8">

                        <div>
                            <p class="text-sm text-gray-500">Starting From</p>

                            <h4 class="text-5xl font-bold text-olive-700">
                                ${
                                    startingPrice
                                        ? '₱' + Number(startingPrice).toLocaleString()
                                        : 'Contact Us'
                                }
                            </h4>
                        </div>
                        <div class="md: bg-olive-600 px-8 py-4 bg-olive-500 hover:bg-olive-600 text-white rounded-xl font-semibold transition max-md:mx-auto mt-5 max-md:text-center">
                        <a href="/hotel?id=${hotel.id}"
                            class="w-full h-full">
                            Book Now
                        </a>
                        </div>

                    </div>

                </div>
            `;


                    const layout = index % 2 === 0 ?
                        `
                    <article class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center bg-white rounded-3xl drop-shadow-lg p-5">
                        ${imageSection}
                        ${contentSection}
                    </article>
                ` :
                        `
                    <article class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center bg-white rounded-3xl drop-shadow-lg p-5">
                        <div class="order-2 lg:order-1 h-full">${contentSection}</div>
                        <div class="order-1 lg:order-2 h-full">${imageSection}</div>
                    </article>
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
