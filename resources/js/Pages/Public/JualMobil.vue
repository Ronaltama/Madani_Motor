<template>
    <Head title="Jual Mobil" />

    <PublicLayout>
        
        <section class="container mx-auto px-4 py-8">
            
            <div class="mb-4">
                <button
                    @click="goBack"
                    class="inline-flex items-center gap-1.5 text-gray-600 hover:text-red-600 transition-colors text-sm group"
                >
                    <svg
                        class="w-4 h-4 transition-colors"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                    <span class="font-medium">Kembali</span>
                </button>
            </div>

            <div class="text-center mb-4">
                <h1 class="text-2xl sm:text-3xl font-bold mb-3">Jual Mobil</h1>
                <div class="w-20 sm:w-24 h-1 bg-[#BB0102] mx-auto rounded-full"></div>
            </div>
        </section>

        <div class="py-6 sm:py-8 md:py-12">
            <div class="container mx-auto px-4">
                <h2 class="text-xl sm:text-2xl font-semibold text-center mb-8 sm:mb-10 md:mb-12 px-4">
                    Kenapa Jual Mobil di Madani Motor?
                </h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 mb-8 sm:mb-10 md:mb-12 max-w-7xl mx-auto">
                    
                    <!-- Card 1 -->
                    <div class="bg-white rounded-2xl shadow-md p-6 sm:p-8 text-center hover:shadow-lg transition-shadow">
                        <h3 class="text-lg sm:text-xl font-medium mb-3 sm:mb-4">
                            Estimasi Harga Instan
                        </h3>
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-4 sm:mb-6 min-h-[3.5rem] sm:min-h-[4.5rem]">
                            Cukup masukkan detail mobil Anda
                            untuk mendapatkan perkiraan harga
                            secara cepat dan transparan.
                        </p>
                        <div class="w-12 sm:w-16 h-1 bg-[#BB0102] mx-auto rounded-full"></div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white rounded-2xl shadow-md p-6 sm:p-8 text-center hover:shadow-lg transition-shadow">
                        <h3 class="text-lg sm:text-xl font-medium mb-3 sm:mb-4">
                            Inspeksi Gratis oleh Tenaga Ahli
                        </h3>
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-4 sm:mb-6 min-h-[3.5rem] sm:min-h-[4.5rem]">
                            Mobil Anda dicek secara menyeluruh
                            tanpa biaya tambahan, bisa di showroom
                            atau langsung di lokasi Anda.
                        </p>
                        <div class="w-12 sm:w-16 h-1 bg-[#BB0102] mx-auto rounded-full"></div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white rounded-2xl shadow-md p-6 sm:p-8 text-center hover:shadow-lg transition-shadow sm:col-span-2 lg:col-span-1 max-w-md mx-auto sm:max-w-none">
                        <h3 class="text-lg sm:text-xl font-medium mb-3 sm:mb-4">
                            Pembayaran Cepat & Aman
                        </h3>
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-4 sm:mb-6 min-h-[3.5rem] sm:min-h-[4.5rem]">
                            Dana langsung ditransfer setelah deal
                            dan dokumen lengkap diterima,
                            proses cepat dan terpercaya.
                        </p>
                        <div class="w-12 sm:w-16 h-1 bg-[#BB0102] mx-auto rounded-full"></div>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="text-center px-4">
                    <button
                        @click="contactWhatsApp"
                        class="bg-[#BB0102] hover:bg-[#990101] text-white font-bold py-2.5 sm:py-3 px-8 sm:px-10 rounded-full text-sm sm:text-base transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 active:scale-95 w-full sm:w-auto max-w-xs sm:max-w-none"
                    >
                        Jual Mobil Sekarang
                    </button>
                </div>
            </div>
        </div>
        
    </PublicLayout>
</template>

<script setup>
// 1. Import Layout yang diperlukan
import PublicLayout from "@/Layouts/PublicLayout.vue";
// 2. Import Head dari Inertia
import { Head } from "@inertiajs/vue3";

// 3. Fungsi untuk tombol kembali
const goBack = () => {
    window.history.back();
};

// 4. Fungsi untuk redirect ke WhatsApp
const contactWhatsApp = () => {
    const phoneNumber = "6281225865661"; // Nomor WhatsApp admin
    // Pesan harus di-encode agar spasi dan karakter khusus bisa dibaca di URL
    const message = encodeURIComponent("Halo, saya tertarik menjual mobil saya kepada Madani Motor.");
    const whatsappUrl = `https://wa.me/${phoneNumber}?text=${message}`;
    window.open(whatsappUrl, '_blank');
};
</script>