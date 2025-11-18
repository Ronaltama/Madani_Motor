<template>
  <section class="py-8 sm:py-12 md:py-16" style="background-color: #f7f7f7;">
    <div class="container mx-auto px-4">
      <!-- Header Section -->
      <div class="text-center mb-8 sm:mb-10 md:mb-12">
        <h1 class="text-xl sm:text-2xl md:text-3xl font-bold mb-2 sm:mb-3 text-gray-900">
          Ulasan dari Pelanggan Kami
        </h1>
        <div class="w-16 sm:w-20 md:w-24 h-1 bg-[#BB0102] mx-auto rounded-full"></div>
        <p class="text-sm sm:text-base text-gray-700 mt-3 sm:mt-4 px-4">
          Simak pengalaman pelanggan Madani Motor setelah bertransaksi bersama kami.
        </p>
      </div>

      <!-- Carousel Container -->
      <div class="relative max-w-6xl mx-auto px-4 sm:px-8 md:px-12">
        <div class="relative pb-8 sm:pb-10 md:pb-12">
          <!-- Cards Container -->
          <div class="overflow-hidden py-4">
            <div 
              class="flex transition-transform duration-500 ease-in-out gap-3 sm:gap-4"
              :style="transformStyle"
            >
              <div 
                v-for="item in ulasanList" 
                :key="item.id" 
                class="flex-shrink-0" 
                :style="itemStyle"
              >
                <CardReview :ulasan="item" />
              </div>
            </div>
          </div>

          <!-- Navigation Buttons -->
          <button 
            @click="prevSlide" 
            :disabled="currentIndex === 0"
            class="absolute -left-2 sm:-left-4 lg:-left-12 top-1/2 -translate-y-1/2 bg-white hover:bg-[#BB0102] text-gray-800 hover:text-white rounded-full p-2 sm:p-3 shadow-lg transition-all duration-300 disabled:opacity-30 disabled:cursor-not-allowed z-10"
          >
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
          </button>

          <button 
            @click="nextSlide" 
            :disabled="currentIndex >= maxIndex"
            class="absolute -right-2 sm:-right-4 lg:-right-12 top-1/2 -translate-y-1/2 bg-white hover:bg-[#BB0102] text-gray-800 hover:text-white rounded-full p-2 sm:p-3 shadow-lg transition-all duration-300 disabled:opacity-30 disabled:cursor-not-allowed z-10"
          >
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </button>
        </div>

        <!-- Dots Indicator -->
        <div class="flex justify-center gap-1.5 sm:gap-2 mt-2">
          <button 
            v-for="index in totalDots" 
            :key="index" 
            @click="goToSlide(index - 1)"
            :class="currentIndex === index - 1 ? 'bg-[#BB0102] w-6 sm:w-8' : 'bg-gray-300 w-2'"
            class="h-1.5 sm:h-2 rounded-full transition-all duration-300 hover:bg-[#BB0102]"
          ></button>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import CardReview from './CardReview.vue'

// Props
const props = defineProps({
  ulasanList: {
    type: Array,
    default: () => [],
  }
})

// State
const currentIndex = ref(0)
const itemsPerView = ref(3)
const gapPx = ref(16) // Default gap-4 = 16px

// Dynamic item width
const itemStyle = computed(() => {
  const n = itemsPerView.value
  if (n === 1) {
    return { width: '100%' }
  }
  const percent = 100 / n
  const compensation = (n - 1) * gapPx.value / n
  return {
    width: `calc(${percent}% - ${compensation}px)`
  }
})

// Dynamic transform for sliding
const transformStyle = computed(() => {
  const offsetPercent = currentIndex.value * 100
  const offsetGap = currentIndex.value * gapPx.value
  return {
    transform: `translateX(calc(-${offsetPercent}% - ${offsetGap}px))`
  }
})

// Calculate max slide index
const maxIndex = computed(() => {
  return Math.max(0, Math.ceil(props.ulasanList.length / itemsPerView.value) - 1)
})

// Total dots for indicator
const totalDots = computed(() => {
  return maxIndex.value + 1
})

// Navigation functions
const nextSlide = () => {
  if (currentIndex.value < maxIndex.value) {
    currentIndex.value++
  }
}

const prevSlide = () => {
  if (currentIndex.value > 0) {
    currentIndex.value--
  }
}

const goToSlide = (index) => {
  currentIndex.value = index
}

// Responsive: Update items per view
const updateItemsPerView = () => {
  const width = window.innerWidth
  if (width < 640) {
    itemsPerView.value = 1 // Mobile
    gapPx.value = 12 // gap-3
  } else if (width < 1024) {
    itemsPerView.value = 2 // Tablet
    gapPx.value = 16 // gap-4
  } else {
    itemsPerView.value = 3 // Desktop
    gapPx.value = 16 // gap-4
  }
  
  // Reset index if exceeds max
  if (currentIndex.value > maxIndex.value) {
    currentIndex.value = maxIndex.value
  }
}

onMounted(() => {
  updateItemsPerView()
  window.addEventListener('resize', updateItemsPerView)
})

onUnmounted(() => {
  window.removeEventListener('resize', updateItemsPerView)
})
</script>

<style scoped>
/* Smooth scrolling for touch devices */
@media (hover: none) {
  .overflow-hidden {
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    -webkit-overflow-scrolling: touch;
  }

  .overflow-hidden > div > div {
    scroll-snap-align: start;
  }
}
</style>