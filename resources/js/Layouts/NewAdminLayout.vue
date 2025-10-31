<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <header class="bg-white border-b">
            <div class="container mx-auto px-4 py-3 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <span class="text-xl font-semibold text-red-600">MADANI MOTOR</span>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="flex items-center space-x-2">
                        <span>Indonesia</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm">
                            AM
                        </div>
                        <div class="text-sm">
                            <div>AdminT</div>
                            <div class="text-gray-500">Admin</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex h-[calc(100vh-64px)]">
            <!-- Sidebar -->
            <aside class="w-64 bg-white border-r flex flex-col">
                <nav class="flex-1 p-4 space-y-1">
                    <Link 
                        v-for="(item, index) in navigation" 
                        :key="index"
                        :href="item.href"
                        :class="[
                            'flex items-center space-x-2 px-3 py-2 rounded-lg transition-colors',
                            route().current(item.route) 
                                ? 'bg-blue-100 text-blue-600' 
                                : 'text-gray-700 hover:bg-gray-50'
                        ]"
                    >
                        <component :is="item.icon" class="w-5 h-5" />
                        <span>{{ item.name }}</span>
                    </Link>
                </nav>

                <!-- Profile & Logout -->
                <div class="border-t p-4">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm">
                            AM
                        </div>
                        <div>
                            <div class="font-medium">AdminT</div>
                            <div class="text-sm text-gray-500">Admin</div>
                        </div>
                    </div>
                    <button 
                        @click="logout" 
                        class="flex items-center space-x-2 text-red-600 hover:text-red-700 transition-colors"
                    >
                        <ArrowRightOnRectangleIcon class="w-5 h-5" />
                        <span>Logout</span>
                    </button>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 overflow-auto">
                <div class="container mx-auto p-6">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { 
    HomeIcon,
    ClipboardDocumentIcon,
    ShoppingCartIcon,
    ChatBubbleLeftIcon,
    ArrowRightOnRectangleIcon
} from '@heroicons/vue/24/outline'

const navigation = [
    { name: 'Dashboard', href: route('admin.dashboard'), icon: HomeIcon, route: 'admin.dashboard' },
    { name: 'Log Aktivitas', href: route('admin.logs'), icon: ClipboardDocumentIcon, route: 'admin.logs' },
    { name: 'Manajemen Produk', href: route('admin.products.index'), icon: ShoppingCartIcon, route: 'admin.products.*' },
    { name: 'Manajemen Ulasan', href: route('admin.reviews.index'), icon: ChatBubbleLeftIcon, route: 'admin.reviews.*' },
]

function logout() {
    // Implement logout
}
</script>