<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { company } from '@/company';
import { waLink } from '@/helpers';

const open = ref(false);
const page = usePage();
const links = [
    { label: 'Beranda', route: 'home' },
    { label: 'Produk', route: 'products.index' },
];
</script>

<template>
    <Head>
        <link rel="icon" type="image/png" href="/images/favicon.png" />
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=archivo:600,700,800" rel="stylesheet" />
    </Head>

    <div class="flex min-h-screen flex-col bg-slate-50 text-slate-800">
        <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur">
            <nav class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4">
                <Link :href="route('home')" class="flex items-center gap-2.5">
                    <img src="/images/logo-mark.png" alt="" class="h-9 w-auto" />
                    <span class="font-display text-lg font-extrabold tracking-tight text-[#06244e]">{{ company.brand }}</span>
                </Link>

                <div class="hidden items-center gap-6 md:flex">
                    <Link v-for="l in links" :key="l.route" :href="route(l.route)"
                        class="text-sm font-medium text-slate-600 hover:text-[#06244e]"
                        :class="{ '!text-[#06244e] underline decoration-orange-500 decoration-2 underline-offset-8': route().current(l.route) }">
                        {{ l.label }}
                    </Link>
                    <a href="/#tentang" class="text-sm font-medium text-slate-600 hover:text-[#06244e]">Tentang</a>
                    <Link :href="page.props.auth?.user ? route('admin.products.index') : route('login')"
                        class="rounded-lg bg-[#06244e] px-3.5 py-2 text-sm font-semibold text-white hover:bg-[#0a3170]">
                        {{ page.props.auth?.user ? 'Panel admin' : 'Masuk admin' }}
                    </Link>
                </div>

                <button class="rounded-lg p-2 text-slate-700 md:hidden" @click="open = !open" :aria-expanded="open" aria-label="Buka menu">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" /></svg>
                </button>
            </nav>
            <div v-if="open" class="space-y-1 border-t border-slate-200 px-4 py-3 md:hidden">
                <Link v-for="l in links" :key="l.route" :href="route(l.route)" class="block rounded-lg px-3 py-2 text-slate-700 hover:bg-slate-100">{{ l.label }}</Link>
                <a href="/#tentang" class="block rounded-lg px-3 py-2 text-slate-700 hover:bg-slate-100" @click="open = false">Tentang</a>
                <Link :href="page.props.auth?.user ? route('admin.products.index') : route('login')" class="block rounded-lg px-3 py-2 font-semibold text-[#06244e] hover:bg-slate-100">
                    {{ page.props.auth?.user ? 'Panel admin' : 'Masuk admin' }}
                </Link>
            </div>
        </header>

        <main class="flex-1"><slot /></main>

        <footer class="bg-[#06244e] text-slate-300">
            <div class="mx-auto grid max-w-6xl gap-8 px-4 py-10 md:grid-cols-3">
                <div>
                    <p class="font-display text-xl font-extrabold text-white">{{ company.brand }}</p>
                    <p class="mt-1 text-sm">{{ company.legalName }}</p>
                    <p class="mt-3 max-w-xs text-sm text-slate-400">{{ company.tagline }}</p>
                </div>
                <div class="text-sm">
                    <p class="font-semibold text-white">Jelajahi</p>
                    <ul class="mt-3 space-y-2">
                        <li><Link :href="route('products.index')" class="hover:text-orange-400">Semua produk</Link></li>
                        <li><a href="/#tentang" class="hover:text-orange-400">Tentang kami</a></li>
                    </ul>
                </div>
                <div class="text-sm">
                    <p class="font-semibold text-white">Hubungi kami</p>
                    <ul class="mt-3 space-y-2">
                        <li><a :href="waLink(company.whatsapp, 'Halo D Stepwear, saya ingin bertanya.')" class="hover:text-orange-400" target="_blank" rel="noopener">WhatsApp</a></li>
                        <li>{{ company.email }}</li>
                        <li>{{ company.address }}</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/10 py-4 text-center text-xs text-slate-400">
                © {{ new Date().getFullYear() }} {{ company.legalName }}. Hak cipta dilindungi.
            </div>
        </footer>
    </div>
</template>

<style>
.font-display { font-family: 'Archivo', ui-sans-serif, system-ui, sans-serif; }
</style>
