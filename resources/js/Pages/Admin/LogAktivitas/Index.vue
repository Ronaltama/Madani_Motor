<template>
    <AdminLayout>
        <div>
            <h1 class="text-xl sm:text-2xl font-semibold mb-4 sm:mb-6">Log Aktivitas</h1>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <!-- Desktop Table View -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-50 text-left">
                                <th class="px-6 py-3 text-gray-600 text-sm font-semibold">ID</th>
                                <th class="px-6 py-3 text-gray-600 text-sm font-semibold">ID ADMIN</th>
                                <th class="px-6 py-3 text-gray-600 text-sm font-semibold">NAMA</th>
                                <th class="px-6 py-3 text-gray-600 text-sm font-semibold">EMAIL</th>
                                <th class="px-6 py-3 text-gray-600 text-sm font-semibold">TANGGAL AKTIVITAS</th>
                                <th class="px-6 py-3 text-gray-600 text-sm font-semibold">ACTIVITY</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            <tr
                                v-for="log in logs.data"
                                :key="log.id_log"
                                class="hover:bg-gray-50"
                            >
                                <td class="px-6 py-4 text-sm">{{ log.id_log ?? "-" }}</td>
                                <td class="px-6 py-4 text-sm">{{ log.id_admin ?? "-" }}</td>
                                <td class="px-6 py-4 text-sm">{{ log.admin?.nama ?? "-" }}</td>
                                <td class="px-6 py-4 text-sm">{{ log.admin?.email ?? "-" }}</td>
                                <td class="px-6 py-4 text-sm">{{ formatDate(log.created_at || log.tanggal) }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-800">
                                        {{ log.aktivitas || log.activity || "-" }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="lg:hidden divide-y">
                    <div
                        v-for="log in logs.data"
                        :key="log.id_log"
                        class="p-4 hover:bg-gray-50"
                    >
                        <div class="space-y-3">
                            <!-- Header -->
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">ID Log</p>
                                    <p class="font-semibold text-gray-900">{{ log.id_log ?? "-" }}</p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs bg-gray-100 text-gray-800">
                                    {{ log.aktivitas || log.activity || "-" }}
                                </span>
                            </div>

                            <!-- Admin Info -->
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">ID Admin</p>
                                    <p class="text-sm text-gray-900">{{ log.id_admin ?? "-" }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Nama</p>
                                    <p class="text-sm text-gray-900">{{ log.admin?.nama ?? "-" }}</p>
                                </div>
                            </div>

                            <!-- Email & Date -->
                            <div class="space-y-2">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Email</p>
                                    <p class="text-sm text-gray-900 break-all">{{ log.admin?.email ?? "-" }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Tanggal</p>
                                    <p class="text-sm text-gray-900">{{ formatDate(log.created_at || log.tanggal) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex flex-col sm:flex-row items-center justify-between px-4 sm:px-6 py-3 border-t gap-3">
                    <span class="text-xs sm:text-sm text-gray-600">
                        Showing {{ logs.from }}-{{ logs.to }} of {{ logs.total }}
                    </span>
                    <div class="flex flex-wrap justify-center gap-2">
                        <template
                            v-for="link in logs.links"
                            :key="link.label + (link.url || '')"
                        >
                            <Link
                                v-if="link.url"
                                :href="link.url"
                                class="px-3 py-1 border rounded text-sm"
                                :class="{
                                    'bg-blue-600 text-white': link.active,
                                    'text-gray-600 hover:bg-gray-100': !link.active,
                                }"
                                v-html="link.label"
                            />
                            <span
                                v-else
                                class="px-3 py-1 border rounded text-gray-400 select-none text-sm"
                                v-html="link.label"
                            />
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    logs: {
        type: Object,
        required: true,
    },
});

function formatDate(date) {
    return new Date(date).toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "short",
        year: "numeric",
    });
}
</script>