<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps({ title: String });
const page = usePage();
const flash = computed(() => page.props.flash?.success);
const nav = [
    { label: 'Produk', route: 'admin.products.index', match: 'admin.products.*' },
    { label: 'Kategori', route: 'admin.categories.index', match: 'admin.categories.*' },
];
</script>

<template>
    <Head :title="title" />
    <div class="min-h-screen bg-slate-100 text-slate-800">
        <header class="bg-[#06244e] text-white">
            <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-3 px-4 py-3">
                <div class="flex items-center gap-6">
                    <Link :href="route('admin.products.index')" class="flex items-center gap-2">
                        <img src="/images/logo-mark.png" alt="" class="h-8 w-auto rounded bg-white p-1" />
                        <span class="font-bold">Panel Admin</span>
                    </Link>
                    <nav class="flex gap-1">
                        <Link v-for="n in nav" :key="n.route" :href="route(n.route)"
                            class="rounded-lg px-3 py-1.5 text-sm hover:bg-white/10"
                            :class="{ 'bg-white/15 font-semibold': route().current(n.match) }">
                            {{ n.label }}
                        </Link>
                    </nav>
                </div>
                <div class="flex items-center gap-4 text-sm">
                    <Link :href="route('home')" class="text-slate-300 hover:text-white">Lihat website</Link>
                    <Link :href="route('logout')" method="post" as="button" class="rounded-lg bg-orange-500 px-3 py-1.5 font-semibold text-white hover:bg-orange-600">Keluar</Link>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-6xl px-4 py-8">
            <div v-if="flash" class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="status">{{ flash }}</div>
            <slot />
        </main>
    </div>
</template>
