<template>
    <PublicLayout>
        <ImageSlider />
        <MobilPilihan :cars="cars" />
        <CompareBox />
        <Ulasan :ulasanList="reviews" />
    </PublicLayout>
</template>

<script setup>
import PublicLayout from "@/Layouts/PublicLayout.vue";
import ImageSlider from "@/components/ImageSlider.vue";
import MobilPilihan from "@/components/MobilPilihan.vue";
import CompareBox from "@/components/CompareBox.vue";
import Ulasan from "@/components/Ulasan.vue";

defineProps({
    cars: {
        type: Array,
        default: () => [],
    },
    reviews: {
        type: Array,
        default: () => [],
    },
});
</script>
