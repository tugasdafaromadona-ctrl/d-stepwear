<script setup>
defineProps({ src: String, alt: String });
</script>

<template>
    <img v-if="src" :src="src" :alt="alt" class="h-full w-full object-cover" loading="lazy" />
    <div v-else class="flex h-full w-full items-center justify-center bg-slate-100 text-slate-300" role="img" :aria-label="`Belum ada foto ${alt ?? ''}`">
        <svg viewBox="0 0 64 64" class="h-1/3 w-1/3" fill="currentColor" aria-hidden="true">
            <path d="M4 40c0-3 1-5 3-6l10-6c3-2 5-5 6-9l1-5 6 3c3 2 7 4 11 5l12 4c4 1 7 4 7 8v8c0 2-2 4-4 4H8c-2 0-4-2-4-4v-2z" />
        </svg>
    </div>
</template>
