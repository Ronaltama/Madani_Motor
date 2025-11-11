<template>
    <PublicLayout>
        <ImageSlider />
        <MobilPilihan :cars="cars" />
        <CompareBox />
    </PublicLayout>
</template>

<script setup>
import PublicLayout from "@/Layouts/PublicLayout.vue";
import ImageSlider from "@/components/ImageSlider.vue";
import MobilPilihan from "@/components/MobilPilihan.vue";
import CompareBox from "@/components/CompareBox.vue";

defineProps({
    cars: {
        type: Array,
        default: () => [],
    },
});
</script>
