<template>
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 p-4"
    >
        <div class="w-full max-w-md">
            <div class="bg-white rounded-lg shadow-2xl overflow-hidden">
                <!-- Header dengan Background Image -->
                <div
                    class="relative h-32 bg-cover bg-center"
                    style="
                        background-image: url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800');
                    "
                >
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-red-500/80 to-pink-500/80"
                    ></div>
                    <div
                        class="relative h-full flex items-center justify-center"
                    >
                        <div class="text-center">
                            <div class="flex items-center justify-center mb-2">
                                <div
                                    class="w-12 h-12 bg-white rounded-full flex items-center justify-center"
                                >
                                    <svg
                                        class="w-8 h-8 text-red-500"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"
                                        />
                                    </svg>
                                </div>
                            </div>
                            <h1
                                class="text-3xl font-bold text-white tracking-wide"
                            >
                                MADANI MOTOR
                            </h1>
                        </div>
                    </div>
                </div>

                <!-- Login Form -->
                <div class="p-8">
                    <h2
                        class="text-2xl font-bold text-gray-800 text-center mb-2"
                    >
                        Login Admin
                    </h2>
                    <p class="text-gray-500 text-center mb-6">
                        Nice to see you again
                    </p>

                    <form @submit.prevent="submitLogin">
                        <!-- Email Input -->
                        <div class="mb-4">
                            <label
                                for="email"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Login
                            </label>
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                placeholder="admin@gmail.com"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200"
                                :class="{ 'border-red-500': errors.email }"
                                required
                            />
                            <p
                                v-if="errors.email"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ errors.email }}
                            </p>
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4">
                            <label
                                for="password"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Password
                            </label>
                            <div class="relative">
                                <input
                                    id="password"
                                    v-model="form.password"
                                    :type="showPassword ? 'text' : 'password'"
                                    placeholder="Admin12345"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200 pr-10"
                                    :class="{
                                        'border-red-500': errors.password,
                                    }"
                                    required
                                />
                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                                >
                                    <svg
                                        v-if="!showPassword"
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
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                        />
                                    </svg>
                                    <svg
                                        v-else
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
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"
                                        />
                                    </svg>
                                </button>
                            </div>
                            <p
                                v-if="errors.password"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ errors.password }}
                            </p>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between mb-6">
                            <label class="flex items-center">
                                <input
                                    v-model="form.remember"
                                    type="checkbox"
                                    class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500"
                                />
                                <span class="ml-2 text-sm text-gray-600"
                                    >Remember me</span
                                >
                            </label>
                            <a
                                href="#"
                                class="text-sm text-blue-600 hover:text-blue-700 font-medium"
                            >
                                Reset password?
                            </a>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            :disabled="processing"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span v-if="!processing">Sign in</span>
                            <span
                                v-else
                                class="flex items-center justify-center"
                            >
                                <svg
                                    class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <circle
                                        class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"
                                    ></circle>
                                    <path
                                        class="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                    ></path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                    </form>
                </div>

                <!-- Back Button -->
                <div class="px-8 pb-8">
                    <a
                        href="/"
                        class="flex items-center justify-center text-gray-600 hover:text-gray-800 transition duration-200"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-2"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"
                            />
                        </svg>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const showPassword = ref(false);
const processing = ref(false);

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const errors = ref({});

const submitLogin = () => {
    processing.value = true;
    errors.value = {};

    form.post("/login", {
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
