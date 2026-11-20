<script setup>
import { Link } from '@inertiajs/vue3';
import ShoeThumb from '@/Components/ShoeThumb.vue';
import { formatRupiah } from '@/helpers';

defineProps({ product: Object });
</script>

<template>
    <Link :href="route('products.show', product.slug)" class="group block overflow-hidden rounded-xl bg-white ring-1 ring-slate-200 transition hover:ring-orange-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-orange-500">
        <div class="aspect-square overflow-hidden">
            <ShoeThumb :src="product.image_url" :alt="product.name" />
        </div>
        <div class="p-4">
            <p class="text-sm text-slate-500">{{ product.category?.name }}</p>
            <h3 class="mt-0.5 font-semibold text-[#06244e] group-hover:text-orange-600">{{ product.name }}</h3>
            <p class="mt-2 font-bold text-slate-900">{{ formatRupiah(product.price) }}</p>
            <p v-if="product.stock === 0" class="mt-1 text-sm text-red-600">Stok habis</p>
        </div>
    </Link>
</template>
