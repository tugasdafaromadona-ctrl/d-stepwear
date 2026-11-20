<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ProductForm from './ProductForm.vue';

defineProps({ categories: Array });
</script>

<template>
    <AdminLayout title="Tambah produk">
        <h1 class="mb-6 text-2xl font-bold text-[#06244e]">Tambah produk</h1>
        <ProductForm :categories="categories" />
    </AdminLayout>
</template>
