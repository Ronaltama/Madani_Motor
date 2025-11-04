<template>
    <Head title="Profile" />

    <AdminLayout>
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Header -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Profile</h2>
            </div>

            <!-- Profile Card -->
            <div
                class="bg-white rounded-lg shadow-sm border border-gray-200 p-8"
            >
                <div class="flex flex-col items-center space-y-6">
                    <!-- Admin Name Section -->
                    <div class="text-center">
                        <p class="text-sm text-gray-500 mb-2">Admin Name</p>
                        <h3 class="text-2xl font-bold text-gray-900">
                            {{ user?.name || "AdminT" }}
                        </h3>
                    </div>

                    <!-- Department Section -->
                    <div class="text-center">
                        <p class="text-sm text-gray-500 mb-2">Department</p>
                        <h3 class="text-xl font-semibold text-gray-900">
                            Tissen
                        </h3>
                    </div>

                    <!-- Logout Button -->
                    <div class="pt-6">
                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="flex items-center gap-2 px-6 py-2.5 text-gray-700 hover:text-gray-900 transition-colors"
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
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const user = computed(() => page.props.auth?.user);
</script>
