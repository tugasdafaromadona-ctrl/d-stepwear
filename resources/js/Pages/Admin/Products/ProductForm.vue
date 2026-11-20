<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({ product: { type: Object, default: null }, categories: Array });

const form = useForm({
    _method: props.product ? 'put' : 'post',
    name: props.product?.name ?? '',
    category_id: props.product?.category_id ?? '',
    price: props.product?.price ?? '',
    stock: props.product?.stock ?? 0,
    description: props.product?.description ?? '',
    is_featured: props.product?.is_featured ?? false,
    image: null,
});

const preview = ref(props.product?.image_url ?? null);

function onFile(e) {
    const file = e.target.files[0] ?? null;
    form.image = file;
    preview.value = file ? URL.createObjectURL(file) : (props.product?.image_url ?? null);
}

function submit() {
    const url = props.product ? route('admin.products.update', props.product.id) : route('admin.products.store');
    form.post(url, { forceFormData: true });
}

const input = 'mt-1 block w-full rounded-lg border-slate-300 text-sm focus:border-orange-500 focus:ring-orange-500';
</script>

<template>
    <form @submit.prevent="submit" class="space-y-5 rounded-xl bg-white p-6 ring-1 ring-slate-200">
        <div>
            <label for="name" class="text-sm font-medium">Nama produk</label>
            <input id="name" v-model="form.name" type="text" maxlength="255" :class="input" />
            <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
        </div>

        <div class="grid gap-5 sm:grid-cols-3">
            <div>
                <label for="category" class="text-sm font-medium">Kategori</label>
                <select id="category" v-model="form.category_id" :class="input">
                    <option value="" disabled>Pilih kategori</option>
                    <option v-for="c in categories" :key="c.id" :value="c.id">{{ c.name }}</option>
                </select>
                <p v-if="form.errors.category_id" class="mt-1 text-sm text-red-600">{{ form.errors.category_id }}</p>
            </div>
            <div>
                <label for="price" class="text-sm font-medium">Harga (Rp)</label>
                <input id="price" v-model="form.price" type="number" min="0" :class="input" />
                <p v-if="form.errors.price" class="mt-1 text-sm text-red-600">{{ form.errors.price }}</p>
            </div>
            <div>
                <label for="stock" class="text-sm font-medium">Stok</label>
                <input id="stock" v-model="form.stock" type="number" min="0" :class="input" />
                <p v-if="form.errors.stock" class="mt-1 text-sm text-red-600">{{ form.errors.stock }}</p>
            </div>
        </div>

        <div>
            <label for="description" class="text-sm font-medium">Deskripsi</label>
            <textarea id="description" v-model="form.description" rows="5" maxlength="2000" :class="input"></textarea>
            <p v-if="form.errors.description" class="mt-1 text-sm text-red-600">{{ form.errors.description }}</p>
        </div>

        <div>
            <label for="image" class="text-sm font-medium">Foto produk <span class="font-normal text-slate-500">(JPG, PNG, atau WEBP, maksimal 2 MB)</span></label>
            <input id="image" type="file" accept="image/png,image/jpeg,image/webp" @change="onFile" class="mt-1 block w-full text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-slate-100 file:px-4 file:py-2 file:font-semibold hover:file:bg-slate-200" />
            <p v-if="form.errors.image" class="mt-1 text-sm text-red-600">{{ form.errors.image }}</p>
            <img v-if="preview" :src="preview" alt="Pratinjau foto" class="mt-3 h-32 w-32 rounded-lg object-cover ring-1 ring-slate-200" />
        </div>

        <label class="flex items-center gap-2 text-sm">
            <input v-model="form.is_featured" type="checkbox" class="rounded border-slate-300 text-orange-500 focus:ring-orange-500" />
            Tampilkan sebagai produk pilihan di beranda
        </label>

        <div class="flex gap-3 pt-2">
            <button :disabled="form.processing" class="rounded-lg bg-[#06244e] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#0a3170] disabled:opacity-50">
                {{ product ? 'Simpan perubahan' : 'Simpan produk' }}
            </button>
            <Link :href="route('admin.products.index')" class="rounded-lg px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100">Batal</Link>
        </div>
    </form>
</template>
