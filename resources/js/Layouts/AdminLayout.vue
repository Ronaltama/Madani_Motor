<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="flex items-center justify-between p-4 bg-white border-b">
            <div class="flex items-center space-x-2">
                <div class="text-xl font-bold">MADANI MOTOR</div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <!-- Replaced missing image with a simple ID badge to avoid missing asset errors -->
                    <span class="inline-flex items-center justify-center w-8 h-5 text-xs font-semibold rounded bg-gray-200 text-gray-700">ID</span>
                    <span>Indonesia</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white">
                        AM
                    </div>
                    <div class="text-sm">
                        <div>AdminT</div>
                        <div class="text-gray-500">Admin</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex">
            <!-- Sidebar -->
            <div class="w-64 min-h-screen bg-white border-r">
                <nav class="p-4 space-y-1">
                    <Link :href="'/admin/dashboard'" 
                        class="flex items-center space-x-2 p-2 rounded-lg"
                        :class="{'bg-blue-100 text-blue-600': $page.url === '/admin/dashboard',
                                'text-gray-700 hover:bg-gray-50': $page.url !== '/admin/dashboard'}">
                        <HomeIcon class="w-5 h-5" />
                        <span>Dashboard</span>
                    </Link>
                    
                    <Link :href="'/admin/log-aktivitas'" 
                        class="flex items-center space-x-2 p-2 rounded-lg"
                        :class="{'bg-blue-100 text-blue-600': $page.url === '/admin/log-aktivitas',
                                'text-gray-700 hover:bg-gray-50': $page.url !== '/admin/log-aktivitas'}">
                        <ClipboardDocumentListIcon class="w-5 h-5" />
                        <span>Log Aktivitas</span>
                    </Link>

                    <Link :href="'/admin/products'" 
                        class="flex items-center space-x-2 p-2 rounded-lg"
                        :class="{'bg-blue-100 text-blue-600': $page.url.startsWith('/admin/products'),
                                'text-gray-700 hover:bg-gray-50': !$page.url.startsWith('/admin/products')}">
                        <ShoppingCartIcon class="w-5 h-5" />
                        <span>Manajemen Produk</span>
                    </Link>

                    <Link :href="'/admin/reviews'" 
                        class="flex items-center space-x-2 p-2 rounded-lg"
                        :class="{'bg-blue-100 text-blue-600': $page.url.startsWith('/admin/reviews'),
                                'text-gray-700 hover:bg-gray-50': !$page.url.startsWith('/admin/reviews')}">
                        <ChatBubbleLeftIcon class="w-5 h-5" />
                        <span>Manajemen Ulasan</span>
                    </Link>
                </nav>

                <!-- Profile Section at Bottom -->
                <div class="absolute bottom-0 left-0 w-64 p-4 bg-white border-t">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white">
                            AM
                        </div>
                        <div>
                            <div class="font-medium">AdminT</div>
                            <div class="text-sm text-gray-500">Admin</div>
                        </div>
                    </div>
                    <button @click="logout" class="flex items-center space-x-2 text-red-600 hover:text-red-700">
                        <ArrowRightOnRectangleIcon class="w-5 h-5" />
                        <span>Logout</span>
                    </button>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1 p-8">
                <slot />
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { 
    HomeIcon,
    ClipboardDocumentListIcon,
    ShoppingCartIcon,
    ChatBubbleLeftIcon,
    ArrowRightOnRectangleIcon
} from '@heroicons/vue/24/outline'

function logout() {
    // Implement logout logic (hooked via NewAdminLayout already if used elsewhere)
}
</script>
