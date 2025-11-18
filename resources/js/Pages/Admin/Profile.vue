<template>
    <Head title="Profile" />

    <AdminLayout>
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Header -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Profile Admin</h2>
                <p class="text-gray-600 mt-1">Kelola informasi profile Anda</p>
            </div>

            <!-- Success Message -->
            <div
                v-if="$page.props.flash.success"
                class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg"
            >
                {{ $page.props.flash.success }}
            </div>

            <!-- Profile Card -->
            <div
                class="bg-white rounded-lg shadow-sm border border-gray-200 p-8"
            >
                <form @submit.prevent="submit" class="space-y-6">
                    <!-- ID Admin (Read-only) -->
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            ID Admin
                        </label>
                        <input
                            type="text"
                            :value="user?.id_admin || '-'"
                            disabled
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600"
                        />
                    </div>

                    <!-- Nama -->
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Nama Admin <span class="text-red-600">*</span>
                        </label>
                        <input
                            v-model="form.nama"
                            type="text"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                            required
                        />
                        <p
                            v-if="form.errors.nama"
                            class="text-red-600 text-sm mt-1"
                        >
                            {{ form.errors.nama }}
                        </p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Email <span class="text-red-600">*</span>
                        </label>
                        <input
                            v-model="form.email"
                            type="email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                            required
                        />
                        <p
                            v-if="form.errors.email"
                            class="text-red-600 text-sm mt-1"
                        >
                            {{ form.errors.email }}
                        </p>
                    </div>

                    <!-- Password -->
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Password Baru (Kosongkan jika tidak ingin mengubah)
                        </label>
                        <input
                            v-model="form.password"
                            type="password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                            placeholder="Minimal 6 karakter"
                        />
                        <p
                            v-if="form.errors.password"
                            class="text-red-600 text-sm mt-1"
                        >
                            {{ form.errors.password }}
                        </p>
                    </div>

                    <!-- Password Confirmation -->
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Konfirmasi Password Baru
                        </label>
                        <input
                            v-model="form.password_confirmation"
                            type="password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                            placeholder="Ulangi password baru"
                        />
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4 pt-4">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-6 py-2.5 bg-red-700 hover:bg-red-800 text-white font-medium rounded-lg transition-colors disabled:opacity-50"
                        >
                            {{
                                form.processing
                                    ? "Menyimpan..."
                                    : "Simpan Perubahan"
                            }}
                        </button>

                        <Link
                            :href="route('admin.dashboard')"
                            class="px-6 py-2.5 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors"
                        >
                            Kembali
                        </Link>
                    </div>
                </form>

                <!-- Logout Section -->
                <div class="border-t mt-8 pt-8">
                    <h3 class="text-lg font-semibold mb-4">Sesi Login</h3>

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
                    <!-- Close border-t wrapper -->
                </div>
                <!-- Close Logout Section wrapper -->
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { computed } from "vue";

const page = usePage();
const user = computed(() => page.props.auth?.user);

const form = useForm({
    nama: user.value?.nama || "",
    email: user.value?.email || "",
    password: "",
    password_confirmation: "",
});

function submit() {
    form.post(route("admin.profile.update"), {
        preserveScroll: true,
        onSuccess: () => {
            form.password = "";
            form.password_confirmation = "";
        },
    });
}
</script>
