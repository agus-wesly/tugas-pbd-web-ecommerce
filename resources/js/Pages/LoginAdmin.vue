<script setup>
import { cn } from "@/lib/utils";
import { ref } from "vue";

import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Link, useForm } from "@inertiajs/vue3";

const isSubmitting = ref(false);

const form = useForm({
    email: null,
    password: null,
});

async function onSubmit(event) {
    event.preventDefault();
    isSubmitting.value = true;

    form.post("/login-admin");
    isSubmitting.value = false;
}
</script>

<template>
    <main class="container mt-10 max-w-xl">
        <h1 class="mb-10 text-3xl font-[900] text-center">Login admin</h1>
        <div :class="cn('grid gap-6', $attrs.class ?? '')">
            <form @submit.prevent="onSubmit">
                <fieldset :disabled="isSubmitting" class="grid gap-4">
                    <div class="grid gap-1">
                        <Label for="email"> Email </Label>
                        <Input
                            id="email"
                            name="email"
                            placeholder="name@example.com"
                            type="email"
                            auto-capitalize="none"
                            auto-complete="email"
                            auto-correct="off"
                            v-model="form.email"
                            required
                        />
                    </div>
                    <div class="grid gap-1">
                        <Label>Password</Label>
                        <Input
                            name="password"
                            type="password"
                            v-model="form.password"
                            required
                        />
                    </div>

                    <!-- <pre class="text-black">
                        {{ JSON.stringify($page) }}
                    </pre> -->
                    <Button type="submit"> Sign In </Button>
                </fieldset>
            </form>
        </div>
    </main>
</template>
