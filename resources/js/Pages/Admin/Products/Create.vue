<template>
	<div class="min-h-screen bg-gray-50 p-8">
		<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
			<h1 class="text-2xl font-semibold mb-4">Tambah Produk Baru</h1>

			<form @submit.prevent="submit">
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label class="block mb-1 text-sm font-medium">Nama Mobil</label>
						<input v-model="form.nama_mobil" type="text" class="w-full border rounded p-2" />
						<p v-if="form.errors.nama_mobil" class="text-sm text-red-600 mt-1">{{ form.errors.nama_mobil }}</p>
					</div>
					<div>
						<label class="block mb-1 text-sm font-medium">Merek</label>
						<input v-model="form.merek" type="text" class="w-full border rounded p-2" />
						<p v-if="form.errors.merek" class="text-sm text-red-600 mt-1">{{ form.errors.merek }}</p>
					</div>
					<div>
						<label class="block mb-1 text-sm font-medium">Varian</label>
						<input v-model="form.varian" type="text" class="w-full border rounded p-2" />
					</div>
					<div>
						<label class="block mb-1 text-sm font-medium">Tipe Penjual</label>
						<select v-model="form.tipe_penjual" class="w-full border rounded p-2">
							<option value="">-- Pilih --</option>
							<option value="Dealer">Dealer</option>
							<option value="Individu">Individu</option>
						</select>
						<p v-if="form.errors.tipe_penjual" class="text-sm text-red-600 mt-1">{{ form.errors.tipe_penjual }}</p>
					</div>
					<div>
						<label class="block mb-1 text-sm font-medium">Tahun</label>
						<input v-model="form.tahun" type="number" class="w-full border rounded p-2" />
						<p v-if="form.errors.tahun" class="text-sm text-red-600 mt-1">{{ form.errors.tahun }}</p>
					</div>
					<div>
						<label class="block mb-1 text-sm font-medium">Kondisi</label>
						<select v-model="form.kondisi" class="w-full border rounded p-2">
							<option value="">-- Pilih --</option>
							<option value="Baru">Baru</option>
							<option value="Bekas">Bekas</option>
						</select>
						<p v-if="form.errors.kondisi" class="text-sm text-red-600 mt-1">{{ form.errors.kondisi }}</p>
					</div>
					<div class="md:col-span-2">
						<label class="block mb-1 text-sm font-medium">Deskripsi</label>
						<textarea v-model="form.deskripsi" rows="3" class="w-full border rounded p-2"></textarea>
					</div>
					<div>
						<label class="block mb-1 text-sm font-medium">Harga</label>
						<input v-model="form.harga" type="number" class="w-full border rounded p-2" />
						<p v-if="form.errors.harga" class="text-sm text-red-600 mt-1">{{ form.errors.harga }}</p>
					</div>
				</div>

				<div class="flex justify-end space-x-2 mt-6">
					<Link href="/admin/products" class="px-4 py-2 border rounded">Kembali</Link>
					<button type="submit" :disabled="form.processing" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
						{{ form.processing ? 'Menyimpan...' : 'Simpan' }}
					</button>
				</div>
			</form>
		</div>
	</div>
</template>

<script setup>
import { Link, useForm, router } from '@inertiajs/vue3'

const form = useForm({
	nama_mobil: '',
	merek: '',
	varian: '',
	tipe_penjual: '',
	tahun: '',
	kondisi: '',
	deskripsi: '',
	harga: ''
})

function submit() {
	form.post('/admin/products', {
		onSuccess: () => {
			router.visit('/admin/products')
		}
	})
}
</script>

