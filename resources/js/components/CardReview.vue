<template>
  <div class="card-review shadow-md rounded-lg bg-white flex flex-col hover:shadow-lg hover:-translate-y-2 transition-all duration-300 overflow-hidden h-full">
    <!-- Gambar Penuh -->
    <div class="w-full pb-[66.67%] relative bg-gray-100 flex-shrink-0">
      <img 
        :src="ulasan.foto" 
        :alt="'Foto ' + ulasan.namaPelanggan" 
        class="absolute inset-0 w-full h-full object-cover"
      >
    </div>
    
    <!-- Content Section -->
    <div class="p-3 sm:p-4 flex flex-col items-center text-center flex-grow">
      <!-- Rating Stars -->
      <div class="flex justify-center mb-1.5 sm:mb-2">
        <span v-for="n in ulasan.rating" :key="n" class="text-yellow-400 text-base sm:text-lg md:text-xl">★</span>
        <span v-for="n in (5 - ulasan.rating)" :key="'empty-' + n" class="text-gray-300 text-base sm:text-lg md:text-xl">★</span>
      </div>
      
      <!-- Nama -->
      <h3 class="font-semibold text-[11px] sm:text-xs text-gray-800 mb-0.5">
        {{ ulasan.namaPelanggan }}
      </h3>
      
      <!-- Mobil -->
      <p class="text-[10px] sm:text-[11px] text-gray-600 mb-0.5">
        {{ ulasan.mobil }}
      </p>
      
      <!-- Tanggal -->
      <p class="text-[10px] sm:text-[11px] text-gray-400 mb-1.5 sm:mb-2">
        {{ ulasan.tanggal }}
      </p>
      
      <!-- Review Text - Scrollable dengan tinggi tetap -->
      <div class="w-full h-14 sm:h-16 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 flex-shrink-0">
        <p class="text-gray-700 italic text-[11px] sm:text-xs leading-relaxed px-1 sm:px-2 font-medium">
          "{{ ulasan.isiUlasan }}"
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CardReview",
  props: {
    ulasan: {
      type: Object,
      required: true
    }
  }
};
</script>

<style scoped>
/* Responsive height untuk card */
.card-review {
  width: 100%;
  height: 100%;
  min-height: 340px; /* Mobile minimum */
}

@media (min-width: 640px) {
  .card-review {
    min-height: 380px; /* Tablet */
  }
}

@media (min-width: 1024px) {
  .card-review {
    min-height: 420px; /* Desktop */
  }
}

/* Custom Scrollbar */
.scrollbar-thin::-webkit-scrollbar {
  width: 3px;
}

@media (min-width: 640px) {
  .scrollbar-thin::-webkit-scrollbar {
    width: 4px;
  }
}

.scrollbar-thin::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

.scrollbar-thin::-webkit-scrollbar-thumb {
  background: #d1d5db;
  border-radius: 10px;
}

.scrollbar-thin::-webkit-scrollbar-thumb:hover {
  background: #9ca3af;
}

/* Firefox scrollbar */
.scrollbar-thin {
  scrollbar-width: thin;
  scrollbar-color: #d1d5db #f1f1f1;
}
</style>