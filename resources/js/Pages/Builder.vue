<template>
    <AuthenticatedLayout>
        <Head title="Builder" />
        <template #header>
            <div class="flex flex-row justify-between content-center">
                <h2 class="font-bold text-xl text-gray-800 leading-tight">
                    Build your own lists
                </h2>
            </div>
        </template>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-40">
                <div class="bg-white shadow-sm sm:rounded-lg mb-2 min-h-40">
                    In progress..
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<style></style>
