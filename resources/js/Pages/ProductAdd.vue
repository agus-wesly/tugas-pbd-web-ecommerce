<script setup lang="ts">
import { cn } from "@/lib/utils";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const isSubmitting = ref(false);

const form = useForm({
    name: null,
    description: null,
    stock: null,
    product_url: null,
    price: null,
    type_id: null,
});

let tempFilePofile = ref<File | null>(null);
let productSrc = computed(() => {
    if (tempFilePofile.value) return URL.createObjectURL(tempFilePofile.value);
    return "/product-placeholder.jpeg";
});

function onSubmit() {
    form.transform((data) => ({
        ...data,
        product_url: tempFilePofile.value,
    })).post("/dashboard/products/add");
}

function handleFileInputChange(e: Event) {
    let inputFile = e.currentTarget as HTMLInputElement;
    let file = inputFile.files?.[0];
    if (!file) return;

    tempFilePofile.value = file;
}
</script>

<template>
    <main class="container mt-10 max-w-xl">
        <h1 class="mb-10 text-3xl font-[900] text-center">Add new product</h1>
        <div :class="cn('grid gap-6', $attrs.class ?? '')">
            <form @submit.prevent="onSubmit">
                <div class="flex flex-col items-center mb-4 gap-2">
                    <div
                        for="file-input"
                        class="flex items-center justify-center w-36 h-36 md:w-48 md:h-48 bg-purple-500 rounded-full mx-auto overflow-hidden"
                    >
                        <img
                            alt="profile"
                            :src="productSrc"
                            class="w-full h-full object-cover"
                        />
                    </div>
                    <label
                        for="file-input"
                        class="text-sm font-bold text-blue-600 cursor-pointer"
                        >Add product image</label
                    >
                </div>
                <input
                    name="profile_url"
                    @change="handleFileInputChange"
                    type="file"
                    class="hidden"
                    id="file-input"
                />
                <fieldset :disabled="isSubmitting" class="grid gap-4">
                    <div class="grid gap-1">
                        <Label for="name">Product name</Label>
                        <Input
                            id="name"
                            name="name"
                            type="name"
                            auto-capitalize="none"
                            auto-complete="name"
                            auto-correct="off"
                            v-model="form.name"
                        />
                        <p
                            class="text-xs text-pink-600"
                            v-if="form.errors.name"
                        >
                            {{ form.errors.name }}
                        </p>
                    </div>
                    <div class="grid gap-1">
                        <Label for="description">Description</Label>
                        <Input
                            id="description"
                            name="description"
                            type="text"
                            auto-capitalize="none"
                            auto-complete="username"
                            auto-correct="off"
                            v-model="form.description"
                        />
                        <p
                            class="text-xs text-pink-600"
                            v-if="form.errors.description"
                        >
                            {{ form.errors.description }}
                        </p>
                    </div>

                    <div class="grid gap-1">
                        <Label>Stok</Label>
                        <Input
                            v-model="form.stock"
                            name="password"
                            type="text"
                        />
                        <p
                            class="text-xs text-pink-600"
                            v-if="form.errors.stock"
                        >
                            {{ form.errors.stock }}
                        </p>
                    </div>
                    <div class="grid gap-1">
                        <Label>Harga produk</Label>
                        <Input v-model="form.price" type="text" />
                        <p
                            class="text-xs text-pink-600"
                            v-if="form.errors.price"
                        >
                            {{ form.errors.price }}
                        </p>
                    </div>

                    <div class="grid gap-1">
                        <Label>Tipe produk</Label>

                        <select v-model="form.type_id">
                            <option :value="1">Sepatu</option>
                            <option :value="2">Baju</option>
                            <option :value="3">Tas</option>
                            <option :value="4">Jam tangan</option>
                            <option :value="5" Kacamata></option>
                        </select>
                        <p
                            class="text-xs text-pink-600"
                            v-if="form.errors.type_id"
                        >
                            {{ form.errors.type_id }}
                        </p>
                    </div>
                    <Button type="submit">Tambah produk</Button>
                </fieldset>
            </form>
        </div>
    </main>
</template>
