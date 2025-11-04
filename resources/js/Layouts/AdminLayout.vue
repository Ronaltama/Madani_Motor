<template>
    <div class="min-h-screen bg-gray-50 flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg fixed h-full overflow-y-auto">
            <!-- Logo -->
            <div class="p-6 border-b">
                <div class="flex items-center justify-center">
                    <img
                        :src="logoUrl"
                        alt="Madani Motor"
                        class="h-12 w-auto object-contain"
                    />
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="p-4 space-y-2">
                <Link
                    :href="route('admin.dashboard')"
                    :class="
                        isActive('admin.dashboard')
                            ? 'bg-red-600 text-white'
                            : 'text-gray-700 hover:bg-red-50'
                    "
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors"
                >
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
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                        />
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </Link>

                <Link
                    :href="route('admin.log-aktivitas')"
                    :class="
                        isActive('admin.log-aktivitas')
                            ? 'bg-red-600 text-white'
                            : 'text-gray-700 hover:bg-red-50'
                    "
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors"
                >
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
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                        />
                    </svg>
                    <span class="font-medium">Log Aktivitas</span>
                </Link>

                <Link
                    :href="route('admin.products.index')"
                    :class="
                        isActive('admin.products.*')
                            ? 'bg-red-600 text-white'
                            : 'text-gray-700 hover:bg-red-50'
                    "
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors"
                >
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
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                        />
                    </svg>
                    <span class="font-medium">Manajemen Produk</span>
                </Link>

                <Link
                    :href="route('admin.reviews.index')"
                    :class="
                        isActive('admin.reviews.*')
                            ? 'bg-red-600 text-white'
                            : 'text-gray-700 hover:bg-red-50'
                    "
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors"
                >
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
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                        />
                    </svg>
                    <span class="font-medium">Manajemen Ulasan</span>
                </Link>
            </nav>

            <!-- Profile Section -->
            <div class="absolute bottom-0 left-0 right-0 border-t bg-white p-4">
                <div class="flex items-center gap-3 mb-3">
                    <div
                        class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center"
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
                    <div>
                        <Link
                            :href="route('admin.profile')"
                            class="text-sm font-medium text-gray-900 hover:text-blue-600"
                            >Profile</Link
                        >
                    </div>
                </div>
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="w-full flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                >
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
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                        />
                    </svg>
                    <span class="font-medium">Logout</span>
                </Link>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Page Content -->
            <main class="p-8">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { Link, usePage, router } from "@inertiajs/vue3";
import { computed } from "vue";

// Logo URL - Static asset from public folder
const logoUrl = "/images/logo_asli.png";

const page = usePage();

// Get current route name from page URL
const currentRouteName = computed(() => {
    const url = page.url;

    if (url === "/admin/dashboard") return "admin.dashboard";
    if (url.startsWith("/admin/log-aktivitas")) return "admin.log-aktivitas";
    if (url.startsWith("/admin/products")) return "admin.products";
    if (url.startsWith("/admin/reviews")) return "admin.reviews";

    return "";
});

const isActive = (routeName) => {
    if (routeName.includes("*")) {
        const prefix = routeName.replace(".*", "");
        return currentRouteName.value?.startsWith(prefix);
    }
    return currentRouteName.value === routeName;
};
</script>
