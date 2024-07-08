<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                List of Previous Games
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2 min-h-96"
                >
                    <div class="p-6 text-gray-900">
                        <div v-if="gameList">
                            <div class="py-12">
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <div
                                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                                    >
                                        <GameListTable
                                            :items="gameList"
                                            :tableHeaders="headers"
                                            @selectedItem="handleItemSelection"
                                        >
                                        </GameListTable>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p v-else class="no-games-text">
                            No games exist yet. Set up a new game by navigating
                            to the
                            <Link href="/dashboard" :class="classes"
                                >Dahsboard</Link
                            >
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import GameListTable from "@/Components/GameListTable.vue";
import { Link } from "@inertiajs/vue3";
import { defineProps, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
const props = defineProps({
    gameList: {
        // type: Array,
        required: true,
    },
});

const gameList = props.gameList;

const headers = [
    "ID",
    "Game",
    "Level",
    "Decks",
    "Card Quantity",
    "Timer",
    "Dice",
    "Deck 1",
    "Deck 2",
    "Deck 3",
    "Created At",
    "Actions",
];

const classes = computed(() =>
    props.active
        ? " w-full   text-start text-base font-medium text-[#e3a00a] bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out"
        : " w-full  text-start text-base font-medium text-[#e3a00a] hover:text-[#ee595d] hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
);

const handleItemSelection = (id) => {
    console.log(id);
    Inertia.visit(`/game-lists/${id}`);
};
</script>

<style>
.no-games-text {
    margin: auto;
    margin-top: 100px;
    padding: 20px;
    background: white;
    width: 400px;
    height: 100px;
    border: solid 10px #f5c863;
    border-radius: 10px;
    text-align: center;
}
</style>
