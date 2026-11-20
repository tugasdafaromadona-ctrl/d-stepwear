<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ProductForm from './ProductForm.vue';

defineProps({ product: Object, categories: Array });
</script>

<template>
    <AdminLayout title="Ubah produk">
        <h1 class="mb-6 text-2xl font-bold text-[#06244e]">Ubah produk</h1>
        <ProductForm :product="product" :categories="categories" />
    </AdminLayout>
</template>
