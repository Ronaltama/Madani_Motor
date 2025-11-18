<template>
    <nav class="bg-white shadow-md fixed w-full top-0 left-0 z-50">
        <div class="max-w-[1400px] mx-auto px-6 py-4 relative">
            <div class="flex items-center justify-between gap-6">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <Link :href="route('home')">
                        <img
                            :src="logoUrl"
                            alt="Madani Motor"
                            class="w-[147px] h-[41px] object-contain"
                        />
                    </Link>
                </div>

                <!-- Search Bar -->
                <div class="flex-1 max-w-[614px] ml-8 relative z-50">
                    <div class="relative transition-all duration-300">
                        <span
                            class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 z-10"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>
                        </span>

                        <input
                            type="text"
                            v-model="searchQuery"
                            @focus="isFocused = true"
                            @blur="isFocused = false"
                            @keyup.enter="handleSearch"
                            :placeholder="
                                isFocused ? 'Ketik kata kunci dan enter' : ''
                            "
                            class="w-full pl-11 pr-4 py-3 rounded-full bg-gray-100 text-sm text-gray-600 placeholder-gray-500 focus:outline-none focus:ring-2 transition-all duration-300 font-semibold"
                            :class="
                                isFocused
                                    ? 'focus:ring-white bg-white'
                                    : 'focus:ring-red-500'
                            "
                        />

                        <transition name="slide-text" mode="out-in">
                            <span
                                v-if="!isFocused && searchQuery.length === 0"
                                :key="currentPlaceholder"
                                class="absolute left-11 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-semibold select-none pointer-events-none"
                            >
                                {{ currentPlaceholder }}
                            </span>
                        </transition>
                    </div>
                </div>

                <!-- Menu -->
                <div class="flex items-center gap-2 ml-12">
                    <Link
                        :href="route('home')"
                        class="px-5 py-2 text-gray-800 hover:bg-gray-100 rounded-full font-semibold text-[15px] transition-colors"
                    >
                        Beranda
                    </Link>
                    <a
                        href="https://wa.me/6298616498342?text=Halo,%20saya%20ingin%20jual%20mobil"
                        target="_blank"
                        class="px-5 py-2 text-gray-800 hover:bg-gray-100 rounded-full font-semibold text-[15px] transition-colors"
                    >
                        Jual Mobil
                    </a>
                    <Link
                        :href="route('compare')"
                        class="px-5 py-2 text-gray-800 hover:bg-gray-100 rounded-full font-semibold text-[15px] transition-colors"
                    >
                        Bandingkan Mobil
                    </Link>

                    <div class="h-6 w-px bg-gray-300 mx-3"></div>

                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <button
                            @click="toggleProfileDropdown"
                            class="p-2 text-gray-800 hover:bg-gray-100 rounded-full transition-colors"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <transition name="dropdown-fade">
                            <div
                                v-if="showProfileDropdown"
                                class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-gray-200 py-2 z-50"
                            >
                                <Link
                                    :href="route('login')"
                                    class="flex items-center px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors"
                                    @click="showProfileDropdown = false"
                                >
                                    <div
                                        class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-red-600"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                            />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-sm">
                                            Login as Admin
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            Akses dashboard administrator
                                        </div>
                                    </div>
                                </Link>
                            </div>
                        </transition>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <transition name="overlay-fade">
            <div
                v-if="isFocused"
                class="fixed inset-0 bg-[rgba(0,0,0,0.2)] transition-opacity duration-300 z-40"
            ></div>
        </transition>
    </nav>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { Link, router } from "@inertiajs/vue3";

// Logo URL - gunakan path public
const logoUrl = "/images/logo_hitam.png";

const searchQuery = ref("");
const isFocused = ref(false);
const showProfileDropdown = ref(false);
const placeholders = [
    "mau cari apa?",
    "Beli mobil bekas terbaru",
    "Jual Mobil",
];
const currentIndex = ref(0);
const currentPlaceholder = ref(placeholders[currentIndex.value]);

let intervalId;

// Click outside handler
const handleClickOutside = (event) => {
    if (!event.target.closest(".relative")) {
        showProfileDropdown.value = false;
    }
};

onMounted(() => {
    intervalId = setInterval(() => {
        if (!isFocused.value) {
            currentIndex.value = (currentIndex.value + 1) % placeholders.length;
            currentPlaceholder.value = placeholders[currentIndex.value];
        }
    }, 2500);

    document.addEventListener("click", handleClickOutside);
});

onUnmounted(() => {
    clearInterval(intervalId);
    document.removeEventListener("click", handleClickOutside);
});

const handleSearch = () => {
    if (searchQuery.value.trim()) {
        router.visit(route("cars.index"), {
            data: { search: searchQuery.value },
            preserveState: true,
        });
    }
};

const toggleProfileDropdown = () => {
    showProfileDropdown.value = !showProfileDropdown.value;
};
</script>

<style scoped>
.slide-text-enter-active {
    animation: slideIn 0.6s ease forwards;
}
.slide-text-leave-active {
    animation: slideOut 0.6s ease forwards;
}

@keyframes slideIn {
    0% {
        opacity: 0;
        transform: translateY(10px) rotateX(15deg);
    }
    60% {
        opacity: 1;
        transform: translateY(-3px) rotateX(0);
    }
    100% {
        transform: translateY(0);
    }
}

@keyframes slideOut {
    0% {
        opacity: 1;
        transform: translateY(0);
    }
    40% {
        transform: translateY(-5px) rotateX(-10deg);
    }
    100% {
        opacity: 0;
        transform: translateY(-15px);
    }
}

.overlay-fade-enter-active,
.overlay-fade-leave-active {
    transition: opacity 0.3s ease;
}
.overlay-fade-enter-from,
.overlay-fade-leave-to {
    opacity: 0;
}

.dropdown-fade-enter-active,
.dropdown-fade-leave-active {
    transition: all 0.2s ease;
}
.dropdown-fade-enter-from {
    opacity: 0;
    transform: translateY(-10px) scale(0.95);
}
.dropdown-fade-leave-to {
    opacity: 0;
    transform: translateY(-10px) scale(0.95);
}
</style>
