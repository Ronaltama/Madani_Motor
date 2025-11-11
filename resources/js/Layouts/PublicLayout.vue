<template>
    <div class="min-h-screen bg-white">
        <Navbar />
        <main class="pt-20">
            <slot />
        </main>
        <Footer />
    </div>
</template>

<script setup>
import Navbar from "@/components/Navbar.vue";
import Footer from "@/components/Footer.vue";
</script>
