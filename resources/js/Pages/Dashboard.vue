<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import VueMultiselect from "vue-multiselect";
import { Head, router, useForm } from "@inertiajs/vue3";
// import ListTable from "@/Components/ListTable.vue";
// import { ref } from "vue";

const props = defineProps({
    categories: Array,
    gameLists: Array,
    games: Array,
    levels: Array,
});

const filterListsByLevelAndCategory = (levelId, categoryId) => {
    const filtered = props.gameLists.filter(
        (list) =>
            list.level_id === levelId?.id && list.category_id === categoryId?.id
    );
    return filtered;
};

const formData = useForm({
    gameType: null,
    selectedNumberOfDecks: null,
    level: null,
    cardDeck1: { category: null, list: null },
    cardDeck2: { category: null, list: null },
    cardDeck3: { category: null, list: null },
    errors: {
        name: null,
        price: null,
    },
});

const handleFormSubmit = () => {
    console.log(formData);
    formData.post(route("dashboard.create"), {
        onSuccess: () => {
            router.visit("/game");
        },
        onError: (error) => {
            console.log("Error", error);
        },
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2 min-h-96"
                >
                    <div class="p-6 text-gray-900">
                        <h3
                            class="font-semibold text-lg text-gray-800 leading-tight ml-2 mb-6"
                        >
                            Select to set up card game
                        </h3>
                        <form @submit.prevent="handleFormSubmit">
                            <div class="form-inputs mt-4 flex flex-row">
                                <div class="w-1/4 px-3 mb-6 md:mb-0">
                                    <div
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    >
                                        Game Type
                                    </div>
                                    <div class="pt-2 pb-4">
                                        <label
                                            class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                            >List of games</label
                                        >
                                        <VueMultiselect
                                            v-model="formData.gameType"
                                            :options="games"
                                            :multiple="false"
                                            placeholder="Select one"
                                            label="title"
                                            track-by="id"
                                            :close-on-select="true"
                                        >
                                        </VueMultiselect>
                                    </div>
                                    <div
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-2"
                                    >
                                        Language Level
                                    </div>
                                    <div class="pt-2">
                                        <label
                                            class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                            >List of levels</label
                                        >
                                        <VueMultiselect
                                            v-model="formData.level"
                                            :options="levels"
                                            :multiple="false"
                                            placeholder="Select one or more"
                                            label="level"
                                            track-by="id"
                                            :close-on-select="true"
                                        >
                                        </VueMultiselect>
                                    </div>
                                    <div
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-6"
                                    >
                                        Number of card decks
                                    </div>
                                    <div class="md:items-center mb-6 mt-2">
                                        <label
                                            class="md:w-2/3 block text-gray-500 font-bold"
                                        >
                                            <input
                                                class="mr-2 leading-tight"
                                                type="radio"
                                                name="card-deck"
                                                value="1"
                                                v-model="
                                                    formData.selectedNumberOfDecks
                                                "
                                            />
                                            <span class="text-sm"> 1 </span>
                                        </label>
                                        <label
                                            class="md:w-2/3 block text-gray-500 font-bold"
                                        >
                                            <input
                                                class="mr-2 leading-tight"
                                                type="radio"
                                                name="card-deck"
                                                value="2"
                                                v-model="
                                                    formData.selectedNumberOfDecks
                                                "
                                            />
                                            <span class="text-sm"> 2 </span>
                                        </label>

                                        <label
                                            class="md:w-2/3 block text-gray-500 font-bold"
                                        >
                                            <input
                                                class="mr-2 text-grey-200 leading-tight"
                                                type="radio"
                                                name="card-deck"
                                                value="3"
                                                v-model="
                                                    formData.selectedNumberOfDecks
                                                "
                                            />
                                            <span class="text-sm"> 3 </span>
                                        </label>
                                    </div>
                                </div>

                                <div
                                    class="w-1/4 px-3 mb-6 md:mb-0 flex flex-col gap-2"
                                >
                                    <div
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    >
                                        List to use for Card Deck 1
                                    </div>
                                    <div class="mb-2">
                                        <label
                                            class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                            >List Category</label
                                        >
                                        <VueMultiselect
                                            v-model="
                                                formData.cardDeck1.category
                                            "
                                            :options="categories"
                                            :multiple="false"
                                            placeholder="Select one"
                                            label="name"
                                            track-by="id"
                                            :close-on-select="true"
                                        >
                                        </VueMultiselect>
                                    </div>
                                    <div class="mb-2">
                                        <label
                                            class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                            >List Name</label
                                        >
                                        <VueMultiselect
                                            v-model="formData.cardDeck1.list"
                                            :options="
                                                filterListsByLevelAndCategory(
                                                    formData.level,
                                                    formData.cardDeck1.category
                                                )
                                            "
                                            :multiple="false"
                                            placeholder="Select one"
                                            label="name"
                                            track-by="id"
                                            :close-on-select="true"
                                        >
                                        </VueMultiselect>
                                    </div>

                                    <div
                                        v-if="
                                            formData.selectedNumberOfDecks > 1
                                        "
                                    >
                                        <div
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-2"
                                        >
                                            List to use for Card Deck 2
                                        </div>
                                        <div class="mb-2">
                                            <label
                                                class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                                >List Category</label
                                            >
                                            <VueMultiselect
                                                v-model="
                                                    formData.cardDeck2.category
                                                "
                                                :options="categories"
                                                :multiple="false"
                                                placeholder="Select one"
                                                label="name"
                                                track-by="id"
                                                :close-on-select="true"
                                            >
                                            </VueMultiselect>
                                        </div>
                                        <div class="mb-2">
                                            <label
                                                class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                                >List Name</label
                                            >
                                            <VueMultiselect
                                                v-model="
                                                    formData.cardDeck2.list
                                                "
                                                :options="
                                                    filterListsByLevelAndCategory(
                                                        formData.level,
                                                        formData.cardDeck2
                                                            .category
                                                    )
                                                "
                                                :multiple="false"
                                                placeholder="Select one"
                                                label="name"
                                                track-by="id"
                                                :close-on-select="true"
                                            >
                                            </VueMultiselect>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="w-1/4 px-3 mb-6 md:mb-0 flex flex-col gap-2"
                                >
                                    <div
                                        v-if="
                                            formData.selectedNumberOfDecks > 2
                                        "
                                    >
                                        <div
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-2"
                                        >
                                            List to use for Card Deck 3
                                        </div>
                                        <div class="mb-2">
                                            <label
                                                class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                                >List Category</label
                                            >
                                            <VueMultiselect
                                                v-model="
                                                    formData.cardDeck3.category
                                                "
                                                :options="categories"
                                                :multiple="false"
                                                placeholder="Select one"
                                                label="name"
                                                track-by="id"
                                                :close-on-select="true"
                                            >
                                            </VueMultiselect>
                                        </div>
                                        <div class="mb-2">
                                            <label
                                                class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                                >List Name</label
                                            >
                                            <VueMultiselect
                                                v-model="
                                                    formData.cardDeck3.list
                                                "
                                                :options="
                                                    filterListsByLevelAndCategory(
                                                        formData.level,
                                                        formData.cardDeck3
                                                            .category
                                                    )
                                                "
                                                :multiple="false"
                                                placeholder="Select one"
                                                label="name"
                                                track-by="id"
                                                :close-on-select="true"
                                            >
                                            </VueMultiselect>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="w-1/4 px-3 mb-6 md:mb-0 flex flex-row items-end justify-end"
                                >
                                    <PrimaryButton type="submit"
                                        >Start Game
                                    </PrimaryButton>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3
                            class="font-bold text-lg text-gray-800 leading-tight mb-4"
                        >
                            All Lists
                        </h3>
                        <ListTable
                            v-for="(list, index) in availableLists"
                            :key="index"
                            :name="list.name"
                            @editList="handleListEdit(list.name)"
                        />
                    </div>
                    {{ subjects }}
                </div> -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
<style>
.multiselect__content-wrapper {
    position: relative;
}
</style>
