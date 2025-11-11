<template>
  <div class="card-review shadow-md rounded-lg bg-white flex flex-col hover:shadow-lg hover:-translate-y-2 transition-all duration-300 overflow-hidden h-full">
    <!-- Gambar Penuh -->
    <img 
      :src="ulasan.foto" 
      :alt="'Foto ' + ulasan.namaPelanggan" 
      class="w-full h-56 object-cover flex-shrink-0"
    >
    
    <!-- Content Section -->
    <div class="p-4 flex flex-col items-center text-center flex-grow">
      <!-- Rating Stars -->
      <div class="flex justify-center mb-2">
        <span v-for="n in ulasan.rating" :key="n" class="text-yellow-400 text-xl">★</span>
        <span v-for="n in (5 - ulasan.rating)" :key="'empty-' + n" class="text-gray-300 text-xl">★</span>
      </div>
      
      <!-- Nama -->
      <h3 class="font-semibold text-xs text-gray-800 mb-0.5">{{ ulasan.namaPelanggan }}</h3>
      
      <!-- Mobil -->
      <p class="text-[11px] text-gray-600 mb-0.5">{{ ulasan.mobil }}</p>
      
      <!-- Tanggal -->
      <p class="text-[11px] text-gray-400 mb-2">{{ ulasan.tanggal }}</p>
      
      <!-- Review Text - Scrollable dengan tinggi tetap -->
      <div class="w-full h-16 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 flex-shrink-0">
        <p class="text-gray-700 italic text-xs leading-relaxed px-2 font-medium">
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
.card-review {
  width: 100%;
  height: 420px; /* Fixed height untuk semua card */
}

/* Custom Scrollbar */
.scrollbar-thin::-webkit-scrollbar {
  width: 4px;
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
</style>