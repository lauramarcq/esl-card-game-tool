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
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <GameDescriptionSection :data="gameOptions" />
                    <CategoriesSection :data="categoryOptions" />
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2"
                    >
                        <div class="p-6 text-gray-900">
                            <h3
                                class="font-semibold text-lg text-gray-800 leading-tight ml-2 mb-6"
                            >
                                Lists
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import GameDescriptionSection from "@/Pages/GameDescriptions/GameDescriptionSection.vue";
import CategoriesSection from "@/Pages/Categories/CategoriesSection.vue";
import { defineProps } from "vue";

const props = defineProps({
    gameOptions: {
        type: Object,
    },
    categoryOptions: {
        type: Object,
    },
});
</script>

<style></style>
