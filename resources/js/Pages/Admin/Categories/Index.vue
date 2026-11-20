<script setup>
import { router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({ categories: Array });

const createForm = useForm({ name: '', description: '' });
const editForm = useForm({ name: '', description: '' });
const editing = ref(null);

const input = 'block w-full rounded-lg border-slate-300 text-sm focus:border-orange-500 focus:ring-orange-500';

function add() {
    createForm.post(route('admin.categories.store'), { preserveScroll: true, onSuccess: () => createForm.reset() });
}
function startEdit(c) {
    editing.value = c.id;
    editForm.name = c.name;
    editForm.description = c.description ?? '';
    editForm.clearErrors();
}
function saveEdit(c) {
    editForm.put(route('admin.categories.update', c.id), { preserveScroll: true, onSuccess: () => (editing.value = null) });
}
function remove(c) {
    router.delete(route('admin.categories.destroy', c.id), {
        preserveScroll: true,
        onBefore: () => confirm(`Hapus kategori "${c.name}"? ${c.products_count} produk di dalamnya ikut terhapus.`),
    });
}
</script>

<template>
    <AdminLayout title="Kelola kategori">
        <h1 class="text-2xl font-bold text-[#06244e]">Kategori</h1>

        <form @submit.prevent="add" class="mt-6 grid gap-3 rounded-xl bg-white p-5 ring-1 ring-slate-200 md:grid-cols-5">
            <div class="md:col-span-2">
                <input v-model="createForm.name" type="text" maxlength="100" placeholder="Nama kategori" aria-label="Nama kategori" :class="input" />
                <p v-if="createForm.errors.name" class="mt-1 text-sm text-red-600">{{ createForm.errors.name }}</p>
            </div>
            <div class="md:col-span-2">
                <input v-model="createForm.description" type="text" maxlength="255" placeholder="Deskripsi singkat (opsional)" aria-label="Deskripsi" :class="input" />
                <p v-if="createForm.errors.description" class="mt-1 text-sm text-red-600">{{ createForm.errors.description }}</p>
            </div>
            <button :disabled="createForm.processing" class="rounded-lg bg-orange-500 px-4 py-2 text-sm font-semibold text-white hover:bg-orange-600 disabled:opacity-50">Tambah kategori</button>
        </form>

        <ul class="mt-6 divide-y divide-slate-100 rounded-xl bg-white ring-1 ring-slate-200">
            <li v-for="c in categories" :key="c.id" class="p-4">
                <div v-if="editing === c.id" class="grid gap-3 md:grid-cols-5">
                    <div class="md:col-span-2">
                        <input v-model="editForm.name" type="text" maxlength="100" aria-label="Nama kategori" :class="input" />
                        <p v-if="editForm.errors.name" class="mt-1 text-sm text-red-600">{{ editForm.errors.name }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <input v-model="editForm.description" type="text" maxlength="255" aria-label="Deskripsi" :class="input" />
                        <p v-if="editForm.errors.description" class="mt-1 text-sm text-red-600">{{ editForm.errors.description }}</p>
                    </div>
                    <div class="flex gap-2">
                        <button @click="saveEdit(c)" :disabled="editForm.processing" class="rounded-lg bg-[#06244e] px-3 py-2 text-sm font-semibold text-white disabled:opacity-50">Simpan</button>
                        <button @click="editing = null" class="rounded-lg px-3 py-2 text-sm text-slate-600 hover:bg-slate-100">Batal</button>
                    </div>
                </div>
                <div v-else class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="font-semibold text-slate-900">{{ c.name }} <span class="ml-1 text-sm font-normal text-slate-500">{{ c.products_count }} produk</span></p>
                        <p class="text-sm text-slate-600">{{ c.description }}</p>
                    </div>
                    <div class="text-sm">
                        <button @click="startEdit(c)" class="font-semibold text-[#06244e] hover:underline">Ubah</button>
                        <button @click="remove(c)" class="ml-4 font-semibold text-red-600 hover:underline">Hapus</button>
                    </div>
                </div>
            </li>
            <li v-if="!categories.length" class="p-8 text-center text-slate-500">Belum ada kategori. Tambahkan kategori pertama di atas.</li>
        </ul>
    </AdminLayout>
</template>
