<template>
    <AuthenticatedLayout :auth="auth">
        <Head title="Builder" />
        <template #header>
            <div class="flex flex-row justify-between content-center">
                <h2 class="font-bold text-xl text-gray-800 leading-tight">
                    Build your own lists
                </h2>
                <Link
                    v-if="
                        currentPath !== '/builder' &&
                        !currentPath.startsWith('/builder/list/item')
                    "
                    href="/builder"
                    class="hover:bg-gray-700 hover:text-white font-bold py-2 rounded-full inline-block p-2"
                    >Back to all options</Link
                >
                <Link
                    v-if="currentPath.startsWith('/builder/list/item')"
                    href="/builder/list"
                    class="hover:bg-gray-700 hover:text-white font-bold py-2 rounded-full inline-block p-2"
                    >Back to all lists</Link
                >
            </div>
        </template>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2"
                    v-if="currentPath === '/builder'"
                >
                    <h3
                        class="font-semibold text-lg text-gray-800 leading-tight m-6"
                    >
                        Click to navigate to the section you want to edit
                    </h3>

                    <div>
                        <Link
                            href="/builder/game-options"
                            class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 inline-block m-4 w-1/3 h-1/3"
                        >
                            <h4 class="font-bold">Game Descriptions</h4>
                            <p>
                                This is a chance to explain the rules of the
                                game. Here you can add and edit the title,
                                subtitle, description, and example you would see
                                in the game stage. Click to create, change or
                                delete a game description.
                            </p>
                        </Link>
                        <Link
                            href="/builder/category"
                            class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 inline-block m-4 w-1/3 h-1/3"
                        >
                            <h4 class="font-bold">Categories</h4>
                            <p>
                                A category is a way to easily access and
                                organise your word lists. It could be a
                                grammatical category or a semmantical category,
                                for example. Click to create, change or delete a
                                category.
                            </p>
                        </Link>

                        <Link
                            href="/builder/list"
                            class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 inline-block m-4 w-1/3 h-1/3"
                        >
                            <h4 class="font-bold">Lists</h4>
                            <p>
                                All the lists available with their corresponding
                                words. Lists must have a language level
                                associated to them and must belong to a
                                category. Click to create, change or delete a
                                list and its items.
                            </p>
                        </Link>
                    </div>
                </div>
                <GameDescriptionSection
                    v-if="currentPath === '/builder/game-options'"
                    :data="gameOptions"
                />
                <CategoriesSection
                    v-if="currentPath === '/builder/category'"
                    :data="categoryOptions"
                />
                <ListsSection
                    v-if="currentPath === '/builder/list'"
                    :data="listOptions"
                    :categories="categoryOptions"
                    :levels="levels"
                />
                <ListItemsSection
                    v-if="currentPath.startsWith('/builder/list/item')"
                    :data="listItems"
                    :lists="listOptions"
                    :levels="levels"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

import GameDescriptionSection from "@/Pages/GameDescriptions/GameDescriptionSection.vue";
import CategoriesSection from "@/Pages/Categories/CategoriesSection.vue";
import ListsSection from "@/Pages/Lists/ListsSection.vue";
import ListItemsSection from "@/Pages/ListItems/ListItemsSection.vue";
import { defineProps, ref, onMounted } from "vue";

const props = defineProps({
    gameOptions: {
        type: Object,
    },
    categoryOptions: {
        type: Object,
    },
    listOptions: {
        type: Object,
    },
    levels: {
        type: Object,
    },
    listItems: {
        type: Object,
    },
    auth: {
        type: Object,
    },
});

let currentPath = ref("");

onMounted(() => {
    currentPath.value = window.location.pathname;
});
</script>

<style></style>
