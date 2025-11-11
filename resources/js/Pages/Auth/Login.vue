<template>
    <div class="flex justify-center items-center h-screen bg-gray-100">
        <div
            class="bg-white p-8 rounded-3xl shadow-lg w-full max-w-md border-2 border-[#BB0102]"
        >
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img :src="logoUrl" alt="Madani Motor Logo" class="h-12" />
            </div>

            <!-- Title -->
            <h2 class="text-2xl font-bold text-center mb-2">Login Admin</h2>
            <p class="text-center text-gray-600 mb-8">Nice to see you again</p>

            <!-- Error Message -->
            <div
                v-if="errors.email || errors.password"
                class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-4"
            >
                <p v-if="errors.email">{{ errors.email }}</p>
                <p v-if="errors.password">{{ errors.password }}</p>
            </div>

            <!-- Form -->
            <form @submit.prevent="submitLogin">
                <!-- Email Input -->
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-semibold mb-2"
                        >Login</label
                    >
                    <input
                        v-model="form.email"
                        type="email"
                        class="border border-gray-300 rounded-lg w-full py-3 px-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-[#BB0102]"
                        placeholder="admin@madanimotor.com"
                        required
                    />
                </div>

                <!-- Password Input -->
                <div class="mb-6">
                    <label
                        class="block text-gray-700 text-sm font-semibold mb-2"
                        >Password</label
                    >
                    <div class="relative">
                        <input
                            v-model="form.password"
                            :type="showPassword ? 'text' : 'password'"
                            class="border border-gray-300 rounded-lg w-full py-3 px-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-[#BB0102]"
                            placeholder="admin123"
                            required
                        />
                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2"
                        >
                            <svg
                                v-if="!showPassword"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5 text-gray-600"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"
                                />
                            </svg>
                            <svg
                                v-else
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5 text-gray-600"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Login Button -->
                <button
                    type="submit"
                    :disabled="processing"
                    class="bg-[#BB0102] text-white w-full py-3 rounded-lg font-semibold hover:bg-[#9a0101] transition-colors disabled:opacity-50 disabled:cursor-not-allowed mb-3"
                >
                    <span v-if="processing">Loading...</span>
                    <span v-else>Log In</span>
                </button>

                <!-- Back Button -->
                <Link
                    :href="route('home')"
                    class="block text-center py-3 px-4 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition-colors"
                >
                    Kembali ke Halaman Utama
                </Link>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useForm, Link } from "@inertiajs/vue3";

// Logo URL - Static asset from public folder
const logoUrl = "/images/logo_asli.png";

const showPassword = ref(false);
const processing = ref(false);

const form = useForm({
    email: "",
    password: "",
});

const errors = ref({});

const submitLogin = () => {
    processing.value = true;
    errors.value = {};

    form.post(route("login"), {
        preserveScroll: true,
        onSuccess: () => {
            processing.value = false;
        },
        onError: (err) => {
            processing.value = false;
            errors.value = err;
        },
    });
};
</script>
