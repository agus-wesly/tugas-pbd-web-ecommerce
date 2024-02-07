<script setup lang="ts">
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/vue3";

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";

import { useForm } from "@inertiajs/vue3";
import { Button } from "@/components/ui/button";

const props = defineProps<{
    products: Array<Product>;
}>();

const form = useForm({});
</script>

<template>
    <AdminLayout>
        <div class="flex mt-5 justify-between items-center">
            <h1 class="text-xl font-bold">List Produk</h1>
            <Link
                href="/dashboard/products/add"
                class="text-sm bg-blue-700 p-2 text-white rounded-md"
                >Tambah Produk</Link
            >
        </div>

        <template v-if="products.length">
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead class="">ID</TableHead>
                        <TableHead class="w-[100px]">Gambar</TableHead>
                        <TableHead>Nama</TableHead>
                        <TableHead>Harga</TableHead>
                        <TableHead>Stok</TableHead>
                        <TableHead class="text-end">Aksi</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="product in products">
                        <TableCell class="font-medium">{{
                            product.id
                        }}</TableCell>
                        <TableCell>
                            <img
                                class="w-20 h-20 object-cover"
                                :src="product.product_url"
                            />
                        </TableCell>
                        <TableCell>{{ product.name }}</TableCell>
                        <TableCell>{{ product.price }}</TableCell>
                        <TableCell>{{ product.qty }}</TableCell>
                        <TableCell class="text-end">
                            <div class="space-x-2">
                                <Button variant="outline">
                                    <Link>Edit</Link>
                                </Button>
                                <Button variant="destructive" class="p-0">
                                    <a
                                        :href="`/dashboard/products/${product.id}/delete`"
                                        class="w-full h-full p-2"
                                        >Hapus</a
                                    >
                                </Button>
                            </div>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </template>
        <template v-else>
            <p>Belum ada produk</p>
        </template>
    </AdminLayout>
</template>
