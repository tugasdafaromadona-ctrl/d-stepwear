<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({ links: Array });
</script>

<template>
    <nav v-if="links && links.length > 3" class="flex flex-wrap items-center justify-center gap-1" aria-label="Halaman">
        <template v-for="(link, i) in links" :key="i">
            <span v-if="!link.url" class="rounded-lg px-3 py-1.5 text-sm text-slate-400" v-html="link.label" />
            <Link v-else :href="link.url" preserve-scroll
                class="rounded-lg px-3 py-1.5 text-sm"
                :class="link.active ? 'bg-[#06244e] text-white' : 'bg-white text-slate-700 ring-1 ring-slate-200 hover:ring-orange-400'"
                v-html="link.label" />
        </template>
    </nav>
</template>
