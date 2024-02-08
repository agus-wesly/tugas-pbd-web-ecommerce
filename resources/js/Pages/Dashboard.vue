<script setup lang="ts">
import AdminLayout from "@/Layouts/AdminLayout.vue";

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import { Button } from "@/components/ui/button";
import { useForm } from "@inertiajs/vue3";

const props = defineProps<{
    orders: Array<Order & { user: { name: string } }>;
}>();

const form = useForm({});
</script>

<template>
    <AdminLayout>
        <h1 class="mt-5 text-xl font-bold">List pesanan</h1>

        <template v-if="orders.length">
            <!-- <template v-if="false"> -->
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-[100px]">ID</TableHead>
                        <TableHead>Nama</TableHead>
                        <TableHead>Alamat</TableHead>
                        <TableHead>Status</TableHead>
                        <TableHead>Total</TableHead>
                        <TableHead class="text-center">Action</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="order in orders">
                        <TableCell class="font-medium">{{
                            order.id
                        }}</TableCell>
                        <TableCell>{{ order.user.name }}</TableCell>
                        <TableCell>{{ order.address }}</TableCell>
                        <TableCell>{{ order.status }}</TableCell>
                        <TableCell>{{ order.total }}</TableCell>
                        <TableCell>
                            <Button
                                @click="form.post(`/order/${order.id}`)"
                                :disabled="order.status === 'S'"
                                variant="secondary"
                                class="bg-blue-700 hover:bg-blue-700 text-white"
                                type="submit"
                                >Konfirmasi</Button
                            >
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </template>
        <template v-else>
            <p>Belum ada pesanan</p>
            <!-- {{ orders }} -->
        </template>
    </AdminLayout>
</template>
