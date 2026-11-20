<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import ProductCard from '@/Components/ProductCard.vue';
import { company } from '@/company';
import { waLink } from '@/helpers';

defineProps({ featured: Array, categories: Array });
</script>

<template>
    <Head :title="`${company.brand} - Sepatu nyaman harga UMKM`" />
    <PublicLayout>
        <!-- Hero: irisan diagonal oranye meniru goresan pada logo -->
        <section class="relative overflow-hidden bg-white">
            <div class="pointer-events-none absolute inset-y-0 right-0 hidden w-1/2 bg-orange-500 md:block" style="clip-path: polygon(38% 0, 100% 0, 100% 100%, 0 100%)"></div>
            <div class="relative mx-auto grid max-w-6xl items-center gap-8 px-4 py-14 md:grid-cols-2 md:py-24">
                <div>
                    <h1 class="font-display text-4xl font-extrabold leading-tight tracking-tight text-[#06244e] sm:text-5xl">
                        {{ company.tagline }}
                    </h1>
                    <p class="mt-5 max-w-md text-lg text-slate-600">
                        Sneakers, sepatu olahraga, sandal, dan sepatu formal dari {{ company.legalName }}. Pilih modelnya, tanya stok lewat WhatsApp.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <Link :href="route('products.index')" class="rounded-lg bg-[#06244e] px-5 py-3 font-semibold text-white hover:bg-[#0a3170]">Lihat produk</Link>
                        <a :href="waLink(company.whatsapp, 'Halo D Stepwear, saya ingin memesan sepatu.')" target="_blank" rel="noopener" class="rounded-lg px-5 py-3 font-semibold text-[#06244e] ring-1 ring-[#06244e]/30 hover:ring-[#06244e]">Pesan via WhatsApp</a>
                    </div>
                </div>
                <div class="flex justify-center md:justify-end">
                    <img src="/images/logo-mark.png" :alt="`Logo ${company.brand}`" class="w-56 drop-shadow-xl sm:w-72 md:w-80" />
                </div>
            </div>
        </section>

        <!-- Produk unggulan -->
        <section class="mx-auto max-w-6xl px-4 py-14">
            <div class="flex items-end justify-between">
                <h2 class="font-display text-2xl font-extrabold text-[#06244e] sm:text-3xl">Produk pilihan</h2>
                <Link :href="route('products.index')" class="text-sm font-semibold text-orange-600 hover:underline">Semua produk</Link>
            </div>
            <div v-if="featured.length" class="mt-6 grid grid-cols-2 gap-4 md:grid-cols-4">
                <ProductCard v-for="p in featured" :key="p.id" :product="p" />
            </div>
            <p v-else class="mt-6 rounded-lg bg-white p-6 text-slate-500 ring-1 ring-slate-200">Belum ada produk pilihan. Tandai produk sebagai "Produk pilihan" di panel admin.</p>
        </section>

        <!-- Kategori -->
        <section class="bg-white">
            <div class="mx-auto max-w-6xl px-4 py-14">
                <h2 class="font-display text-2xl font-extrabold text-[#06244e] sm:text-3xl">Belanja per kategori</h2>
                <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <Link v-for="c in categories" :key="c.id" :href="route('products.index', { kategori: c.slug })"
                        class="rounded-xl border-l-4 border-orange-500 bg-slate-50 p-5 hover:bg-slate-100">
                        <h3 class="font-semibold text-[#06244e]">{{ c.name }}</h3>
                        <p class="mt-1 text-sm text-slate-600">{{ c.description }}</p>
                        <p class="mt-3 text-sm font-medium text-slate-500">{{ c.products_count }} produk</p>
                    </Link>
                </div>
            </div>
        </section>

        <!-- Deskripsi usaha -->
        <section id="tentang" class="mx-auto max-w-6xl scroll-mt-20 px-4 py-14">
            <div class="grid gap-10 md:grid-cols-5">
                <div class="md:col-span-3">
                    <h2 class="font-display text-2xl font-extrabold text-[#06244e] sm:text-3xl">Tentang {{ company.brand }}</h2>
                    <p class="mt-1 text-sm font-semibold text-orange-600">{{ company.legalName }}</p>
                    <p v-for="(t, i) in company.about" :key="i" class="mt-4 max-w-prose leading-relaxed text-slate-700">{{ t }}</p>
                </div>
                <ul class="space-y-5 md:col-span-2">
                    <li v-for="v in company.values" :key="v.title" class="border-l-4 border-[#06244e] pl-4">
                        <p class="font-semibold text-[#06244e]">{{ v.title }}</p>
                        <p class="mt-0.5 text-sm text-slate-600">{{ v.text }}</p>
                    </li>
                </ul>
            </div>
        </section>
    </PublicLayout>
</template>
