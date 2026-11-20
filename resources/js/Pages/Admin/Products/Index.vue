<script setup>
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ShoeThumb from '@/Components/ShoeThumb.vue';
import Pagination from '@/Components/Pagination.vue';
import { formatRupiah } from '@/helpers';

defineProps({ products: Object });

function remove(p) {
    router.delete(route('admin.products.destroy', p.id), {
        preserveScroll: true,
        onBefore: () => confirm(`Hapus produk "${p.name}"? Tindakan ini tidak bisa dibatalkan.`),
    });
}
</script>

<template>
    <AdminLayout title="Kelola produk">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-[#06244e]">Produk</h1>
            <Link :href="route('admin.products.create')" class="rounded-lg bg-orange-500 px-4 py-2 text-sm font-semibold text-white hover:bg-orange-600">Tambah produk</Link>
        </div>

        <div class="mt-6 overflow-x-auto rounded-xl bg-white ring-1 ring-slate-200">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-4 py-3 font-semibold">Foto</th>
                        <th class="px-4 py-3 font-semibold">Nama</th>
                        <th class="px-4 py-3 font-semibold">Kategori</th>
                        <th class="px-4 py-3 font-semibold">Harga</th>
                        <th class="px-4 py-3 font-semibold">Stok</th>
                        <th class="px-4 py-3 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr v-for="p in products.data" :key="p.id">
                        <td class="px-4 py-3"><div class="h-12 w-12 overflow-hidden rounded-lg"><ShoeThumb :src="p.image_url" :alt="p.name" /></div></td>
                        <td class="px-4 py-3 font-medium text-slate-900">{{ p.name }}<span v-if="p.is_featured" class="ml-2 rounded bg-orange-100 px-1.5 py-0.5 text-xs text-orange-700">Pilihan</span></td>
                        <td class="px-4 py-3">{{ p.category?.name }}</td>
                        <td class="px-4 py-3">{{ formatRupiah(p.price) }}</td>
                        <td class="px-4 py-3">{{ p.stock }}</td>
                        <td class="whitespace-nowrap px-4 py-3 text-right">
                            <Link :href="route('admin.products.edit', p.id)" class="font-semibold text-[#06244e] hover:underline">Ubah</Link>
                            <button @click="remove(p)" class="ml-4 font-semibold text-red-600 hover:underline">Hapus</button>
                        </td>
                    </tr>
                    <tr v-if="!products.data.length">
                        <td colspan="6" class="px-4 py-10 text-center text-slate-500">Belum ada produk. Klik "Tambah produk" untuk memulai.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-6"><Pagination :links="products.links" /></div>
    </AdminLayout>
</template>
