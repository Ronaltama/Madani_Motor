<template>
    <section
        class="relative w-full max-w-[1600px] mx-auto mt-[25px] mb-[25px] px-4 sm:px-6 md:px-8 lg:px-12"
    >
        <div class="relative group">
            <swiper
                :modules="[Autoplay, Pagination, Navigation]"
                :autoplay="{ delay: 2500, disableOnInteraction: false }"
                :pagination="{ clickable: true }"
                :navigation="{
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                }"
                loop
                class="rounded-2xl overflow-hidden shadow-lg"
            >
                <swiper-slide v-for="(img, i) in images" :key="i">
                    <img
                        :src="img"
                        alt="Banner"
                        class="w-full h-full object-cover slider-image"
                    />
                </swiper-slide>
            </swiper>

            <div
                class="swiper-button-prev nav-custom absolute top-1/2 -translate-y-1/2 left-0 -translate-x-1/2 w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20 lg:w-24 lg:h-24 bg-white text-black rounded-full flex items-center justify-center shadow-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 hover:bg-gray-100 cursor-pointer z-10"
                style="
                    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25),
                        0 6px 20px rgba(0, 0, 0, 0.15);
                "
                role="button"
                aria-label="Previous"
                data-custom
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    class="chev-svg"
                    aria-hidden="true"
                    focusable="false"
                >
                    <path
                        d="M15 18l-6-6 6-6"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </div>

            <div
                class="swiper-button-next nav-custom absolute top-1/2 -translate-y-1/2 right-0 translate-x-1/2 w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20 lg:w-24 lg:h-24 bg-white text-black rounded-full flex items-center justify-center shadow-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 hover:bg-gray-100 cursor-pointer z-10"
                style="
                    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25),
                        0 6px 20px rgba(0, 0, 0, 0.15);
                "
                role="button"
                aria-label="Next"
                data-custom
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    class="chev-svg"
                    aria-hidden="true"
                    focusable="false"
                >
                    <g transform="scale(-1,1) translate(-24,0)">
                        <path
                            d="M15 18l-6-6 6-6"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </g>
                </svg>
            </div>
        </div>
    </section>
</template>

<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay, Pagination, Navigation } from "swiper/modules";
import "swiper/css";
import "swiper/css/pagination";
import "swiper/css/navigation";

const images = [
    "/images/sliders/GambarSlider1.png",
    "/images/sliders/GambarSlider2.png",
    "/images/sliders/GambarSlider3.png",
];
</script>

<style scoped>
/* Aspect ratio untuk mobile: tinggi ditambah 25% dari original */
/* Original: 2.96:1, dengan +25% tinggi = 2.96:1.25 = 2.37:1 */
.swiper {
    aspect-ratio: 2.37 / 1;
    width: 100%;
}

/* Tablet ke atas: tinggi ditambah 10% dari original */
/* Original: 2.96:1, dengan +10% tinggi = 2.96:1.1 = 2.69:1 */
@media (min-width: 768px) {
    .swiper {
        aspect-ratio: 2.69 / 1;
    }
}

/* Image mengikuti container dengan object-fit cover */
.slider-image {
    width: 100%;
    height: 100%;
}

/* Mobile: SEMBUNYIKAN tombol navigasi sepenuhnya */
@media (max-width: 767px) {
    :deep(.swiper-button-prev),
    :deep(.swiper-button-next) {
        display: none !important;
    }
}

/* Pagination bullets - Ubah ke warna putih dengan :deep() */
:deep(.swiper-pagination-bullet) {
    background-color: #ffffff !important;
    opacity: 0.6;
}
:deep(.swiper-pagination-bullet-active) {
    background-color: #ffffff !important;
    opacity: 1;
}

/* Pastikan pseudo default Swiper dan ikon bawaan tidak tampil */
:deep(.swiper-button-prev::after),
:deep(.swiper-button-next::after) {
    display: none !important;
    content: none !important;
}

/* Sembunyikan seluruh SVG default atau background-image yang mungkin dibuat oleh Swiper */
:deep(.swiper-button-prev svg:not(.chev-svg)),
:deep(.swiper-button-next svg:not(.chev-svg)),
:deep(.swiper-button-prev .swiper-button-icon),
:deep(.swiper-button-next .swiper-button-icon) {
    display: none !important;
    visibility: hidden !important;
    width: 0 !important;
    height: 0 !important;
}

/* Pastikan tombol custom tetap menggunakan Tailwind visual, tambahkan safety */
:deep(.swiper-button-prev),
:deep(.swiper-button-next) {
    color: #1e1e1e !important;
    background: #ffffff !important;
    border-radius: 9999px !important;
    box-shadow: 0 10px 40px rgba(34, 34, 34, 0.25),
        0 6px 20px rgba(36, 36, 36, 0.25) !important;
    background-image: none !important;
}

/* Ukuran SVG chevron - responsive */
.chev-svg {
    width: 32px;
    height: 32px;
    display: block;
    line-height: 1;
    transform: translateY(0);
    pointer-events: none;
    color: #111827;
}

@media (min-width: 640px) {
    .chev-svg {
        width: 40px;
        height: 40px;
    }
}

@media (min-width: 768px) {
    .chev-svg {
        width: 48px;
        height: 48px;
    }
}

@media (min-width: 1024px) {
    .chev-svg {
        width: 56px;
        height: 56px;
    }
}

:deep(.nav-custom) {
    padding: 0;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

:deep(.swiper-button-prev *),
:deep(.swiper-button-next *) {
    pointer-events: none;
}

:deep(.swiper-button-prev),
:deep(.swiper-button-next) {
    background-image: none !important;
}
</style>