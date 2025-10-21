<template>
    <div class="min-h-screen bg-gray-50">
        <Navbar />

        <!-- Hero Section -->
        <section class="relative bg-gradient-to-r from-gray-100 to-gray-200">
            <div class="container mx-auto px-6 py-16">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <!-- Left Content -->
                    <div class="space-y-6">
                        <div class="inline-block">
                            <div
                                class="bg-red-600 text-white px-6 py-3 rounded-lg shadow-lg"
                            >
                                <h2 class="text-2xl font-bold">
                                    Dealer Terpercaya
                                </h2>
                                <p class="text-sm mt-1">
                                    Bebas Konsultasi sampai Puas
                                </p>
                            </div>
                        </div>
                        <h1 class="text-5xl font-bold text-gray-800">
                            MADANI <span class="text-red-600">MOTOR</span>
                        </h1>
                        <div class="bg-white p-6 rounded-lg shadow-md max-w-md">
                            <p class="text-gray-700 italic">
                                "Mantap Sekali, Beli Mobil di Sini Pelayanannya
                                Ramah, Bebas bisa tanya apa aja, mobilnya
                                berkualitas, dan Terpercaya."
                            </p>
                            <div class="flex items-center mt-4">
                                <div class="flex text-yellow-400">
                                    ⭐⭐⭐⭐⭐
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Image -->
                    <div class="relative">
                        <img
                            :src="heroCarImage"
                            alt="Madani Motor"
                            class="w-full h-auto rounded-lg shadow-2xl"
                        />
                        <div
                            class="absolute -bottom-6 -left-6 bg-white p-4 rounded-lg shadow-lg"
                        >
                            <img
                                :src="familyImage"
                                alt="Happy Family"
                                class="w-32 h-auto rounded"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mobil Pilihan Section -->
        <section class="container mx-auto px-6 py-16">
            <h2 class="text-4xl font-bold text-center mb-12">
                Mobil Pilihan
                <div class="w-20 h-1 bg-red-600 mx-auto mt-2"></div>
            </h2>

            <!-- Rekomendasi -->
            <div class="mb-16">
                <h3 class="text-2xl font-bold mb-6">
                    Rekomendasi
                    <div class="w-16 h-1 bg-red-600 mt-1"></div>
                </h3>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6"
                >
                    <CarCard
                        v-for="mobil in rekomendasi"
                        :key="mobil.id_mobil"
                        :mobil="mobil"
                    />
                </div>
            </div>

            <!-- Tahun Terbaru -->
            <div>
                <h3 class="text-2xl font-bold mb-6">
                    Tahun Terbaru
                    <div class="w-16 h-1 bg-red-600 mt-1"></div>
                </h3>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6"
                >
                    <CarCard
                        v-for="mobil in tahunTerbaru"
                        :key="mobil.id_mobil"
                        :mobil="mobil"
                    />
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section v-if="reviews && reviews.length > 0" class="bg-gray-100 py-16">
            <div class="container mx-auto px-6">
                <h2 class="text-4xl font-bold text-center mb-12">
                    Testimoni Pelanggan
                    <div class="w-20 h-1 bg-red-600 mx-auto mt-2"></div>
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        v-for="review in reviews"
                        :key="review.id_review"
                        class="bg-white p-6 rounded-lg shadow-md"
                    >
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <span v-for="i in review.rating" :key="i"
                                    >⭐</span
                                >
                            </div>
                        </div>
                        <p class="text-gray-700 mb-4">
                            {{ review.isi_review }}
                        </p>
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 bg-gray-300 rounded-full mr-3"
                            ></div>
                            <div>
                                <p class="font-semibold">
                                    {{ review.nama_pelanggan }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ formatDate(review.tanggal) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <Footer />
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import Navbar from "@/components/Navbar.vue";
import CarCard from "@/components/CarCard.vue";
import Footer from "@/components/Footer.vue";

const props = defineProps({
    rekomendasi: Array,
    tahunTerbaru: Array,
    reviews: Array,
});

// Gunakan variable untuk path gambar agar tidak di-import oleh Vite
const heroCarImage = "/images/hero-car.png";
const familyImage = "/images/family.png";

const formatDate = (date) => {
    if (!date) return "";
    const d = new Date(date);
    return d.toLocaleDateString("id-ID", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
};
</script>
