<template>
    <nav class="bg-white shadow-md fixed w-full top-0 left-0 z-50">
        <div class="hidden lg:block">
            <div class="max-w-[1400px] mx-auto px-6 py-4 relative">
                <div class="flex items-center justify-between gap-6">
                    <div class="flex-shrink-0">
                        <Link :href="route('home')">
                            <img
                                :src="logoUrl"
                                alt="Madani Motor"
                                class="w-[147px] h-[41px] object-contain"
                            />
                        </Link>
                    </div>

                    <div class="flex-1 max-w-[540px] ml-8 relative z-50">
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
                                        : 'focus:ring-[#BB0102]'
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

                    <div class="flex items-center gap-2 ml-8">
                        <Link
                            :href="route('home')"
                            class="px-5 py-2 text-gray-800 hover:bg-gray-100 rounded-full font-semibold text-[15px] transition-colors"
                        >
                            Home
                        </Link>

                        <Link
                            :href="route('cars.index')"
                            class="px-5 py-2 text-gray-800 hover:bg-gray-100 rounded-full font-semibold text-[15px] transition-colors"
                        >
                            Beli Mobil
                        </Link>

                        <Link
                            :href="route('jual.mobil')"
                            class="px-5 py-2 text-gray-800 hover:bg-gray-100 rounded-full font-semibold text-[15px] transition-colors"
                        >
                            Jual Mobil
                        </Link>
                        <Link
                            :href="route('compare')"
                            class="px-5 py-2 text-gray-800 hover:bg-gray-100 rounded-full font-semibold text-[15px] transition-colors"
                        >
                            Bandingkan Mobil
                        </Link>

                        <div class="h-6 w-px bg-gray-300 mx-3"></div>

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

                            <transition name="dropdown-fade">
                                <div
                                    v-if="showProfileDropdown"
                                    class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-gray-200 py-2 z-50"
                                >
                                    <Link
                                        :href="route('login')"
                                        class="flex items-center px-4 py-3 text-gray-700 hover:bg-[#FFF5F5] hover:text-[#BB0102] transition-colors"
                                        @click="showProfileDropdown = false"
                                    >
                                        <div
                                            class="w-10 h-10 bg-[#FFF5F5] rounded-full flex items-center justify-center mr-3"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 text-[#BB0102]"
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
                                            <div
                                                class="font-semibold text-sm"
                                            >
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
        </div>

        <div class="lg:hidden">
            <div class="flex items-center justify-between px-4 py-3">
                <div class="flex items-center gap-3">
                    <button
                        @click="toggleSidebar"
                        class="p-2 text-gray-800 hover:bg-gray-100 rounded-lg transition-colors"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>
                    </button>

                    <Link :href="route('home')" class="flex-shrink-0">
                        <img
                            :src="logoUrl"
                            alt="Madani Motor"
                            class="h-8 object-contain"
                        />
                    </Link>
                </div>

                <div class="relative">
                    <button
                        @click="toggleProfileDropdown"
                        class="p-2 text-gray-800 hover:bg-gray-100 rounded-lg transition-colors"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
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

                    <transition name="dropdown-fade">
                        <div
                            v-if="showProfileDropdown"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-gray-200 py-2 z-50"
                        >
                            <Link
                                :href="route('login')"
                                class="flex items-center px-4 py-3 text-gray-700 hover:bg-[#FFF5F5] hover:text-[#BB0102] transition-colors"
                                @click="showProfileDropdown = false"
                            >
                                <div
                                    class="w-10 h-10 bg-[#FFF5F5] rounded-full flex items-center justify-center mr-3"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-[#BB0102]"
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

            <div class="px-4 pb-3">
                <div class="relative transition-all duration-300">
                    <span
                        class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 z-10"
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
                        v-model="searchQueryMobile"
                        @focus="isFocusedMobile = true"
                        @blur="isFocusedMobile = false"
                        @keyup.enter="handleSearchMobile"
                        :placeholder="
                            isFocusedMobile ? 'Ketik kata kunci dan enter' : ''
                        "
                        class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-gray-100 text-sm text-gray-600 placeholder-gray-500 focus:outline-none focus:ring-2 transition-all duration-300 font-medium"
                        :class="
                            isFocusedMobile
                                ? 'focus:ring-white bg-white'
                                : 'focus:ring-[#BB0102]'
                        "
                    />
                    <transition name="slide-text" mode="out-in">
                        <span
                            v-if="!isFocusedMobile && searchQueryMobile.length === 0"
                            :key="currentPlaceholder"
                            class="absolute left-10 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-medium select-none pointer-events-none"
                        >
                            {{ currentPlaceholder }}
                        </span>
                    </transition>
                </div>
            </div>
        </div>

        <transition name="sidebar-slide">
            <div
                v-if="showSidebar"
                class="fixed top-0 left-0 h-full w-64 bg-white shadow-2xl z-50 lg:hidden overflow-y-auto"
            >
                <div class="flex items-center justify-between p-4">
                    <img
                        :src="logoUrl"
                        alt="Madani Motor"
                        class="h-8 object-contain"
                    />
                    <button
                        @click="toggleSidebar"
                        class="p-2 text-gray-800 hover:bg-gray-100 rounded-lg transition-colors"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
                
                <div class="px-4">
                    <div class="border-b border-gray-200"></div>
                </div>

                <div class="py-4">
                    <Link
                        :href="route('home')"
                        @click="toggleSidebar"
                        class="flex items-center px-6 py-3 text-gray-800 hover:bg-gray-100 transition-colors"
                    >
                        Beranda

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-4 text-gray-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                            />
                        </svg>
                        <span class="font-semibold">Home</span>

                    </Link>

                    <Link
                        :href="route('cars.index')"
                        @click="toggleSidebar"
                        class="flex items-center px-6 py-3 text-gray-800 hover:bg-gray-100 transition-colors"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-4 text-gray-600"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                        >
                            <!-- Icon Mobil Tampak Samping -->
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16H9m10 0h1.5a1.5 1.5 0 001.5-1.5V12m0 0l-2-5.5H16m6 5.5H4m0 0V9a1 1 0 011-1h5l2-3h4l2 3h5"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.5 16H2a1 1 0 01-1-1v-2a1 1 0 011-1h1.5"/>
                        </svg>
                        <span class="font-semibold">Beli Mobil</span>
                    </Link>

                    <Link
                        :href="route('jual.mobil')"
                        @click="toggleSidebar"
                        class="flex items-center px-6 py-3 text-gray-800 hover:bg-gray-100 transition-colors"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-4 text-gray-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                        <span class="font-semibold">Jual Mobil</span>
                    </Link>

                    <Link
                        :href="route('compare')"
                        @click="toggleSidebar"
                        class="flex items-center px-6 py-3 text-gray-800 hover:bg-gray-100 transition-colors"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-4 text-gray-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                            />
                        </svg>
                        <span class="font-semibold">Bandingkan Mobil</span>
                    </Link>
                </div>

                <div class="absolute bottom-0 left-0 right-0 bg-gray-50">
                    <div class="px-4">
                        <div class="border-t border-gray-200"></div>
                    </div>
                    <div class="p-4">
                        <Link
                            :href="route('login')"
                            @click="toggleSidebar"
                            class="flex items-center justify-center px-6 py-3 bg-[#BB0102] text-white rounded-lg hover:bg-[#9a0101] transition-colors font-semibold"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-2"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                                />
                            </svg>
                            Login Admin
                        </Link>
                    </div>
                </div>
            </div>
        </transition>

        <transition name="overlay-fade">
            <div
                v-if="isFocused"
                class="fixed inset-0 bg-[rgba(0,0,0,0.2)] transition-opacity duration-300 z-40 hidden lg:block"
            ></div>
        </transition>
    </nav>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { Link, router } from "@inertiajs/vue3";

const logoUrl = "/images/logo_hitam.png";

const searchQuery = ref("");
const searchQueryMobile = ref("");
const isFocused = ref(false);
const isFocusedMobile = ref(false);
const showProfileDropdown = ref(false);
const showSidebar = ref(false);

const placeholders = [
    "mau cari apa?",
    "Beli mobil bekas terbaru",
    "Jual Mobil",
];
const currentIndex = ref(0);
const currentPlaceholder = ref(placeholders[currentIndex.value]);

let intervalId;

const handleClickOutside = (event) => {
    if (!event.target.closest(".relative")) {
        showProfileDropdown.value = false;
    }
};

onMounted(() => {
    intervalId = setInterval(() => {
        if (!isFocused.value && !isFocusedMobile.value) {
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

const handleSearchMobile = () => {
    if (searchQueryMobile.value.trim()) {
        router.visit(route("cars.index"), {
            data: { search: searchQueryMobile.value },
            preserveState: true,
        });
    }
};

const toggleProfileDropdown = () => {
    showProfileDropdown.value = !showProfileDropdown.value;
};

const toggleSidebar = () => {
    showSidebar.value = !showSidebar.value;
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

.sidebar-slide-enter-active,
.sidebar-slide-leave-active {
    transition: transform 0.3s ease;
}
.sidebar-slide-enter-from,
.sidebar-slide-leave-to {
    transform: translateX(-100%);
}
</style>