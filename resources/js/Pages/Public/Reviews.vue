<template>
  <PublicLayout>
    <section class="max-w-6xl mx-auto px-6 py-10">
      <div class="text-center mb-12">
        <h1 class="text-3xl font-bold mb-3">Testimoni Pelanggan</h1>
        <div class="w-24 h-1 bg-[#BB0102] mx-auto rounded-full"></div>
        <p class="text-gray-600 mt-4">Lihat apa kata pelanggan kami tentang Madani Motor</p>
      </div>

      <div v-if="reviews && reviews.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="review in reviews"
          :key="review.id_review"
          class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow"
        >
          <!-- Rating -->
          <div class="flex items-center mb-4">
            <div class="flex text-yellow-400">
              <svg
                v-for="i in review.rating"
                :key="i"
                class="w-5 h-5 fill-current"
                viewBox="0 0 24 24"
              >
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
              </svg>
              <svg
                v-for="i in (5 - review.rating)"
                :key="'empty-' + i"
                class="w-5 h-5 text-gray-300 fill-current"
                viewBox="0 0 24 24"
              >
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
              </svg>
            </div>
          </div>

          <!-- Review Text -->
          <p class="text-gray-700 mb-4 italic">"{{ review.isi_review }}"</p>

          <!-- Customer Info -->
          <div class="flex items-center pt-4 border-t border-gray-200">
            <div class="w-12 h-12 bg-gradient-to-br from-[#BB0102] to-red-400 rounded-full flex items-center justify-center text-white font-bold text-lg mr-3">
              {{ getInitials(review.nama_pelanggan) }}
            </div>
            <div>
              <p class="font-semibold text-gray-800">{{ review.nama_pelanggan }}</p>
              <p class="text-sm text-gray-500">{{ formatDate(review.tanggal) }}</p>
            </div>
          </div>

          <!-- Photo if exists -->
          <div v-if="review.foto_url" class="mt-4">
            <img
              :src="review.foto_url"
              :alt="`Foto dari ${review.nama_pelanggan}`"
              class="w-full h-48 object-cover rounded-lg"
            />
          </div>
        </div>
      </div>

      <div v-else class="text-center text-gray-500 py-20">
        <svg class="w-24 h-24 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
        <p class="text-xl font-semibold">Belum ada testimoni</p>
      </div>

      <!-- CTA Section -->
      <div class="mt-12 bg-gradient-to-r from-[#BB0102] to-red-600 rounded-2xl p-8 text-white text-center">
        <h2 class="text-2xl font-bold mb-3">Sudah Beli Mobil di Madani Motor?</h2>
        <p class="mb-6 opacity-90">Bagikan pengalaman Anda dengan calon pembeli lainnya!</p>
        <a
          href="https://wa.me/6298616498342?text=Halo,%20saya%20ingin%20memberikan%20testimoni"
          target="_blank"
          class="inline-block px-8 py-3 bg-white text-[#BB0102] rounded-full font-bold hover:bg-gray-100 transition-colors shadow-lg"
        >
          Kirim Testimoni via WhatsApp
        </a>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue'

defineProps({
  reviews: {
    type: Array,
    default: () => []
  }
})

const getInitials = (name) => {
  if (!name) return '?'
  const parts = name.trim().split(' ')
  if (parts.length === 1) return parts[0].charAt(0).toUpperCase()
  return (parts[0].charAt(0) + parts[parts.length - 1].charAt(0)).toUpperCase()
}

const formatDate = (date) => {
  if (!date) return ''
  const d = new Date(date)
  return d.toLocaleDateString('id-ID', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
}
</script>
