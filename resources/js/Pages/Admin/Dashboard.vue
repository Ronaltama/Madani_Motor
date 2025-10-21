<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Sidebar -->
        <aside class="fixed left-0 top-0 h-full w-64 bg-white shadow-lg z-40">
            <div class="p-6">
                <!-- Logo -->
                <div class="flex items-center mb-8">
                    <div
                        class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center"
                    >
                        <svg
                            class="w-6 h-6 text-white"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"
                            />
                        </svg>
                    </div>
                    <span class="ml-2 text-xl font-bold text-gray-800"
                        >MADANI MOTOR</span
                    >
                </div>

                <!-- Navigation Menu -->
                <nav class="space-y-2">
                    <a
                        href="/admin/dashboard"
                        class="flex items-center px-4 py-3 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-200"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-3"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                            />
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <a
                        href="/admin/users"
                        class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100 transition duration-200"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-3"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                            />
                        </svg>
                        <span>Manajemen User</span>
                    </a>

                    <a
                        href="/admin/products"
                        class="flex items-center px-4 py-3 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition duration-200"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-3"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                            />
                        </svg>
                        <span>Manajemen Produk</span>
                    </a>

                    <a
                        href="/admin/reviews"
                        class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100 transition duration-200"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-3"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                            />
                        </svg>
                        <span>Manajemen Ulasan</span>
                    </a>
                </nav>
            </div>

            <!-- Profile & Logout at Bottom -->
            <div
                class="absolute bottom-0 left-0 right-0 p-6 border-t border-gray-200"
            >
                <div class="flex items-center mb-4">
                    <div
                        class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center"
                    >
                        <img
                            v-if="user.avatar"
                            :src="user.avatar"
                            alt="Profile"
                            class="h-10 w-10 rounded-full"
                        />
                        <span v-else class="text-white font-semibold">{{
                            user.initials
                        }}</span>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-semibold text-gray-800">
                            {{ user.nama }}
                        </p>
                        <p class="text-xs text-gray-500">Admin</p>
                    </div>
                </div>
                <button
                    @click="logout"
                    class="flex items-center w-full px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg transition duration-200"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 mr-3"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                        />
                    </svg>
                    <span>Logout</span>
                </button>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="ml-64 min-h-screen">
            <!-- Top Header -->
            <header class="bg-white shadow-sm sticky top-0 z-30">
                <div class="flex items-center justify-between px-8 py-4">
                    <!-- Search Bar -->
                    <div class="flex-1 max-w-xl">
                        <div class="relative">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>
                            <input
                                type="text"
                                placeholder="Search"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            />
                        </div>
                    </div>

                    <!-- Right Side - Language & Profile -->
                    <div class="flex items-center space-x-4 ml-6">
                        <div
                            class="flex items-center space-x-2 px-3 py-2 border border-gray-300 rounded-lg"
                        >
                            <img
                                src="https://flagcdn.com/w40/id.png"
                                alt="Indonesia"
                                class="h-5 w-7"
                            />
                            <span class="text-sm text-gray-700">Indonesia</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div
                                class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center"
                            >
                                <span class="text-white font-semibold">{{
                                    user.initials
                                }}</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ user.nama }}
                                </p>
                                <p class="text-xs text-gray-500">Admin</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-8">
                    Manajemen Produk
                </h1>

                <!-- Table -->
                <div class="bg-white rounded-lg shadow">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                    >
                                        ID
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                    >
                                        MEREK
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                    >
                                        NAMA KLIEN
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                    >
                                        MASA BERLAKU
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                    >
                                        ACTION
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                    >
                                        STATUS
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr
                                    v-for="product in products"
                                    :key="product.id"
                                    class="hover:bg-gray-50 transition duration-150"
                                >
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                    >
                                        {{ product.id }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                    >
                                        {{ product.merek }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                    >
                                        {{ product.klien }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"
                                    >
                                        {{ product.masa_berlaku }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div
                                            class="flex items-center space-x-2"
                                        >
                                            <button
                                                class="p-2 text-red-600 hover:bg-red-50 rounded-full transition duration-200"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"
                                                    />
                                                </svg>
                                            </button>
                                            <button
                                                class="p-2 text-green-600 hover:bg-green-50 rounded-full transition duration-200"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M5 13l4 4L19 7"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                                            :class="{
                                                'bg-green-100 text-green-800':
                                                    product.status ===
                                                    'Completed',
                                                'bg-purple-100 text-purple-800':
                                                    product.status ===
                                                    'Processing',
                                                'bg-red-100 text-red-800':
                                                    product.status ===
                                                    'Rejected',
                                                'bg-yellow-100 text-yellow-800':
                                                    product.status ===
                                                    'On Hold',
                                                'bg-blue-100 text-blue-800':
                                                    product.status ===
                                                    'In Transit',
                                            }"
                                        >
                                            {{ product.status }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div
                        class="px-6 py-4 border-t border-gray-200 flex items-center justify-between"
                    >
                        <p class="text-sm text-gray-600">Showing 1-01 of 3</p>
                        <div class="flex space-x-2">
                            <button
                                class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50 transition duration-200"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 19l-7-7 7-7"
                                    />
                                </svg>
                            </button>
                            <button
                                class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50 transition duration-200"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    products: {
        type: Array,
        default: () => [],
    },
});

const user = computed(() => ({
    ...props.user,
    initials: props.user.nama
        .split(" ")
        .map((n) => n[0])
        .join("")
        .toUpperCase()
        .slice(0, 2),
}));

const logout = () => {
    router.post("/logout");
};
</script>
