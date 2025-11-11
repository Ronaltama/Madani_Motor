<template>
    <AdminLayout>
        <div>
            <h1 class="text-2xl font-semibold mb-6">Log Aktivitas</h1>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-50 text-left">
                            <th class="px-6 py-3 text-gray-600">ID</th>
                            <th class="px-6 py-3 text-gray-600">ID ADMIN</th>
                            <th class="px-6 py-3 text-gray-600">NAMA</th>
                            <th class="px-6 py-3 text-gray-600">EMAIL</th>
                            <th class="px-6 py-3 text-gray-600">
                                TANGGAL AKTIVITAS
                            </th>
                            <th class="px-6 py-3 text-gray-600">ACTIVITY</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <tr
                            v-for="log in logs.data"
                            :key="log.id_log"
                            class="hover:bg-gray-50"
                        >
                            <td class="px-6 py-4">{{ log.id_log || '-' }}</td>
                            <td class="px-6 py-4">{{ log.id_admin || '-' }}</td>
                            <td class="px-6 py-4">{{ log.admin?.nama || '-' }}</td>
                            <td class="px-6 py-4">{{ log.admin?.email || '-' }}</td>
                            <td class="px-6 py-4">
                                {{ formatDate(log.created_at || log.tanggal) }}
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-800"
                                >
                                    {{ log.aktivitas || log.activity || '-' }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div
                    class="flex items-center justify-between px-6 py-3 border-t"
                >
                    <span class="text-sm text-gray-600">
                        Showing {{ logs.from }}-{{ logs.to }} of
                        {{ logs.total }}
                    </span>
                    <div class="flex space-x-2">
                        <template
                            v-for="link in logs.links"
                            :key="link.label + (link.url || '')"
                        >
                            <Link
                                v-if="link.url"
                                :href="link.url"
                                class="px-3 py-1 border rounded"
                                :class="{
                                    'bg-blue-600 text-white': link.active,
                                    'text-gray-600 hover:bg-gray-100':
                                        !link.active,
                                }"
                                v-html="link.label"
                            />
                            <span
                                v-else
                                class="px-3 py-1 border rounded text-gray-400 select-none"
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
