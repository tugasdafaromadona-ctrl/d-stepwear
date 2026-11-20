<script setup>
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import ProductCard from '@/Components/ProductCard.vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({ products: Object, categories: Array, filters: Object });
const q = ref(props.filters.q ?? '');

function apply(extra = {}) {
    router.get(
        route('products.index'),
        { q: q.value || undefined, kategori: props.filters.kategori || undefined, ...extra },
        { preserveState: true, preserveScroll: true },
    );
}
</script>

<template>
    <Head title="Produk" />
    <PublicLayout>
        <div class="mx-auto max-w-6xl px-4 py-10">
            <h1 class="font-display text-3xl font-extrabold text-[#06244e]">Semua produk</h1>

            <div class="mt-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div class="flex flex-wrap gap-2">
                    <button @click="apply({ kategori: undefined })" class="rounded-full px-4 py-1.5 text-sm font-medium"
                        :class="!filters.kategori ? 'bg-[#06244e] text-white' : 'bg-white text-slate-700 ring-1 ring-slate-200 hover:ring-orange-400'">Semua</button>
                    <button v-for="c in categories" :key="c.id" @click="apply({ kategori: c.slug })" class="rounded-full px-4 py-1.5 text-sm font-medium"
                        :class="filters.kategori === c.slug ? 'bg-[#06244e] text-white' : 'bg-white text-slate-700 ring-1 ring-slate-200 hover:ring-orange-400'">{{ c.name }}</button>
                </div>
                <form @submit.prevent="apply()" class="flex gap-2">
                    <input v-model="q" type="search" maxlength="100" placeholder="Cari nama sepatu" aria-label="Cari produk"
                        class="w-full rounded-lg border-slate-300 text-sm focus:border-orange-500 focus:ring-orange-500 md:w-64" />
                    <button class="rounded-lg bg-orange-500 px-4 text-sm font-semibold text-white hover:bg-orange-600">Cari</button>
                </form>
            </div>

            <div v-if="products.data.length" class="mt-8 grid grid-cols-2 gap-4 md:grid-cols-4">
                <ProductCard v-for="p in products.data" :key="p.id" :product="p" />
            </div>
            <p v-else class="mt-8 rounded-lg bg-white p-8 text-center text-slate-500 ring-1 ring-slate-200">Tidak ada produk yang cocok. Coba kata kunci atau kategori lain.</p>

            <div class="mt-10"><Pagination :links="products.links" /></div>
        </div>
    </PublicLayout>
</template>
