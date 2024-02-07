<script setup lang="ts">
import AdminLayout from "@/Layouts/AdminLayout.vue";
import ProductList from "@/components/product-list.vue";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";

const props = defineProps<{
    orders: Array<Order>;
}>();

let typeProductList = computed(
    () => Object.keys(props) as Array<keyof typeof props>
);
</script>

<template>
    <AdminLayout>
        <h1 class="mt-5 text-xl font-bold">List pesanan</h1>

        <template v-if="orders.length">
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-[100px]">ID</TableHead>
                        <TableHead>Alamat</TableHead>
                        <TableHead>Status</TableHead>
                        <TableHead>Total</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="order in orders">
                        <TableCell class="font-medium">{{
                            order.id
                        }}</TableCell>
                        <TableCell>{{ order.address }}</TableCell>
                        <TableCell>{{ order.status }}</TableCell>
                        <TableCell>{{ order.total }}</TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </template>
        <template v-else>
            <p>Belum ada pesanan</p>
        </template>
    </AdminLayout>
</template>
