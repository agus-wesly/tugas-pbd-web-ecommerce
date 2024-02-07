<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";

import { router } from "@inertiajs/vue3";

const inputValue = ref("");
const openModal = ref(false);

const hrefSearch = computed(() => {
    if (!inputValue.value) return "#";
    return `/search?q=${inputValue.value}`;
});
</script>

<template>
    <nav
        class="container max-w-3xl sticky z-[5] top-0 flex justify-between items-center py-5 bg-white border-b gap-2"
    >
        <p>
            <span class="text-2xl font-extrabold flex-1">Dashboard</span>
        </p>
        <div class="space-x-5">
            <Link class="underline text-blue-600" href="/dashboard"
                >Orders</Link
            >
            <Link class="underline text-blue-600" href="/dashboard/products"
                >Products</Link
            >
        </div>
    </nav>

    <main
        class="container max-w-3xl space-y-5 md:space-y-10 mb-20 min-h-[90vh] overflow-x-hidden"
    >
        <slot />
    </main>
</template>
