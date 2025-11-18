<template>
    <div class="min-h-screen bg-white flex flex-col">
        <Navbar />
        
        <main class="pt-[102px] lg:pt-[73px] flex-1">
            <slot />
        </main>
        
        <Footer />
    </div>
</template>

<script setup>
import Navbar from "@/components/Navbar.vue";
import Footer from "@/components/Footer.vue";
</script>