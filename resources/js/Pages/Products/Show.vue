<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import ProductCard from '@/Components/ProductCard.vue';
import ShoeThumb from '@/Components/ShoeThumb.vue';
import { company } from '@/company';
import { formatRupiah, waLink } from '@/helpers';

const props = defineProps({ product: Object, related: Array });
const wa = waLink(company.whatsapp, `Halo D Stepwear, saya ingin memesan ${props.product.name} (${formatRupiah(props.product.price)}). Apakah stok masih ada?`);
</script>

<template>
    <Head :title="product.name" />
    <PublicLayout>
        <div class="mx-auto max-w-6xl px-4 py-10">
            <nav class="text-sm text-slate-500" aria-label="Breadcrumb">
                <Link :href="route('products.index')" class="hover:text-[#06244e]">Produk</Link>
                <span class="mx-2">/</span>
                <Link :href="route('products.index', { kategori: product.category.slug })" class="hover:text-[#06244e]">{{ product.category.name }}</Link>
            </nav>

            <div class="mt-6 grid gap-8 md:grid-cols-2">
                <div class="aspect-square overflow-hidden rounded-2xl bg-white ring-1 ring-slate-200">
                    <ShoeThumb :src="product.image_url" :alt="product.name" />
                </div>
                <div>
                    <h1 class="font-display text-3xl font-extrabold text-[#06244e]">{{ product.name }}</h1>
                    <p class="mt-3 text-3xl font-bold text-slate-900">{{ formatRupiah(product.price) }}</p>
                    <p class="mt-2 text-sm" :class="product.stock > 0 ? 'text-emerald-700' : 'text-red-600'">
                        {{ product.stock > 0 ? `Stok tersedia: ${product.stock} pasang` : 'Stok habis' }}
                    </p>
                    <p class="mt-6 max-w-prose whitespace-pre-line leading-relaxed text-slate-700">{{ product.description }}</p>
                    <a :href="wa" target="_blank" rel="noopener"
                        class="mt-8 inline-block rounded-lg bg-orange-500 px-6 py-3 font-semibold text-white hover:bg-orange-600">Pesan via WhatsApp</a>
                </div>
            </div>

            <section v-if="related.length" class="mt-16">
                <h2 class="font-display text-xl font-extrabold text-[#06244e]">Produk serupa</h2>
                <div class="mt-5 grid grid-cols-2 gap-4 md:grid-cols-4">
                    <ProductCard v-for="p in related" :key="p.id" :product="p" />
                </div>
            </section>
        </div>
    </PublicLayout>
</template>
