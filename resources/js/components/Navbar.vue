<template>
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div
                        class="bg-red-600 text-white px-3 py-1 rounded-md font-bold text-lg"
                    >
                        MADANI MOTOR
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="flex-1 max-w-md mx-8">
                    <div class="relative">
                        <input
                            type="text"
                            v-model="searchQuery"
                            placeholder="Search"
                            class="w-full px-4 py-2 pl-10 pr-4 text-gray-700 bg-gray-100 border-0 rounded-full focus:outline-none focus:ring-2 focus:ring-red-500"
                        />
                        <svg
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                        </svg>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-6">
                    <Link
                        href="/"
                        class="text-gray-700 hover:text-red-600 font-medium transition"
                    >
                        Home
                    </Link>
                    <Link
                        href="/jual-mobil"
                        class="text-gray-700 hover:text-red-600 font-medium transition"
                    >
                        Jual Mobil
                    </Link>
                    <Link
                        href="/bandingkan"
                        class="text-gray-700 hover:text-red-600 font-medium transition"
                    >
                        Bandingkan Mobil
                    </Link>

                    <!-- User Menu -->
                    <div class="relative">
                        <button
                            @click.stop="toggleDropdown"
                            class="flex items-center space-x-2 focus:outline-none hover:opacity-80 transition"
                        >
                            <div
                                class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center"
                            >
                                <svg
                                    class="w-6 h-6 text-gray-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    />
                                </svg>
                            </div>
                            <svg
                                class="w-4 h-4 text-gray-600 transition-transform duration-200"
                                :class="{ 'rotate-180': dropdownOpen }"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <Transition
                            enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95"
                        >
                            <div
                                v-show="dropdownOpen"
                                class="absolute right-0 mt-2 w-52 bg-white rounded-lg shadow-xl py-2 border border-gray-100 z-50"
                            >
                                <Link
                                    href="/login"
                                    @click="dropdownOpen = false"
                                    class="block px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-150"
                                >
                                    <div class="flex items-center space-x-3">
                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                                            />
                                        </svg>
                                        <span class="font-medium"
                                            >Login as Admin</span
                                        >
                                    </div>
                                </Link>
                            </div>
                        </Transition>
                    </div>

                    <!-- Indonesia Flag -->
                    <div class="flex items-center space-x-2 ml-2">
                        <div class="flex flex-col w-6">
                            <div class="h-2 bg-red-600 rounded-t"></div>
                            <div
                                class="h-2 bg-white rounded-b border border-gray-300"
                            ></div>
                        </div>
                        <span class="text-sm text-gray-600">Indonesia</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { Link } from "@inertiajs/vue3";

const searchQuery = ref("");
const dropdownOpen = ref(false);

const toggleDropdown = () => {
    dropdownOpen.value = !dropdownOpen.value;
};

const closeDropdown = (event) => {
    // Close dropdown when clicking outside
    if (dropdownOpen.value) {
        dropdownOpen.value = false;
    }
};

onMounted(() => {
    // Add click listener to document to close dropdown when clicking outside
    document.addEventListener("click", closeDropdown);
});

onUnmounted(() => {
    // Clean up event listener
    document.removeEventListener("click", closeDropdown);
});
</script>

<style scoped>
.rotate-180 {
    transform: rotate(180deg);
}
</style>
