<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import VueMultiselect from "vue-multiselect";
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, watchEffect } from "vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    categories: Array,
    gameLists: Array,
    games: Array,
    levels: Array,
});

const cardQuantity = ref([6, 9, 12, 15, 20]);

const filterListsByLevelAndCategory = (levelId, categoryId) => {
    const filtered = props.gameLists.filter(
        (list) =>
            list.level_id === levelId?.id && list.category_id === categoryId?.id
    );
    const selectAll = { name: "Select All", id: 0 };
    filtered.unshift(selectAll);
    return filtered;
};

const formData = useForm({
    gameType: null,
    selectedNumberOfDecks: null,
    cardQuantity: null,
    level: null,
    cardDeck1: { category: null, list: [] },
    cardDeck2: { category: null, list: [] },
    cardDeck3: { category: null, list: [] },
    showTimer: false,
    showDice: false,
    showStopwatch: false,
    errors: {
        gameType: null,
        selectedNumberOfDecks: null,
        cardQuantity: null,
        level: null,
        "cardDeck1.category": null,
        "cardDeck2.category": null,
        "cardDeck3.category": null,
        "cardDeck1.list": null,
        "cardDeck2.list": null,
        "cardDeck3.list": null,
    },
});

const removeSelectAll = () => {
    if (formData.cardDeck1.list[0]?.id === 0) {
        formData.cardDeck1.list.shift();
    }
    if (
        formData.cardDeck2.category !== null &&
        formData.cardDeck2.list[0]?.id === 0
    ) {
        formData.cardDeck2.list.shift();
    }
    if (
        formData.cardDeck3.category !== null &&
        formData.cardDeck3.list[0]?.id === 0
    ) {
        formData.cardDeck3.list.shift();
    }
    return formData;
};

const handleFormSubmit = () => {
    removeSelectAll();
    formData.post(route("dashboard.create"), {
        onSuccess: () => {
            router.visit("/game");
        },
        onError: (error) => {
            console.log("Error", error);
        },
    });
};

const handleSelectAll = (options, deck) => {
    if (options.id === 0) {
        const allOptions = filterListsByLevelAndCategory(
            formData.level,
            formData[deck].category
        );
        formData[deck].list = allOptions;
    }
    formData.errors[`${deck}.list`] = "";
};

const handleRemoveAll = (options, deck) => {
    if (options.id === 0) {
        formData[deck].list = [];
    }
};

const numberOfDecks = ref([{ id: 1 }, { id: 2 }, { id: 3 }]);

watchEffect(() => {
    console.log(formData.showTimer, formData.showStopwatch);
});
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
                            class="font-semibold text-xl text-gray-800 leading-tight m-6 mb-10"
                        >
                            Before you can start a game, you must follow the
                            steps below.
                        </h3>
                        <p
                            class="text-gray-800 leading-tight m-6 mb-10 text-xs"
                        >
                            Alternatively, you can click on 'Latest Game' to
                            play the most recent game, or 'All Games' to see a
                            list of all previous games, in the top menu.
                        </p>
                        <form @submit.prevent="handleFormSubmit">
                            <div class="form-inputs m-6 flex flex-col">
                                <div class="flex flex-col">
                                    <div
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    >
                                        Step 1: Select one game type and one
                                        language level.
                                    </div>
                                    <div class="flex flex-row gap-10 px-12">
                                        <div class="pt-2 pb-4 w-1/3">
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
                                                @select="
                                                    formData.errors.gameType =
                                                        ''
                                                "
                                            >
                                            </VueMultiselect>
                                            <InputError
                                                :message="
                                                    formData.errors.gameType
                                                "
                                                class="mt-2"
                                                id="level-error"
                                            />
                                        </div>

                                        <div class="pt-2 pb-4 w-1/3">
                                            <label
                                                class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                                >List of levels</label
                                            >
                                            <VueMultiselect
                                                v-model="formData.level"
                                                :options="levels"
                                                :multiple="false"
                                                placeholder="Select one"
                                                label="level"
                                                track-by="id"
                                                :close-on-select="true"
                                                @select="
                                                    formData.errors.level = ''
                                                "
                                            >
                                            </VueMultiselect>
                                            <InputError
                                                :message="formData.errors.level"
                                                class="mt-2"
                                                id="level-error"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-6" />
                                <div class="flex flex-col">
                                    <div
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-6"
                                    >
                                        Step 2: Select how many decks you want
                                        to use in your game and select how many
                                        cards per deck.
                                    </div>

                                    <div class="flex flex-row px-12">
                                        <div class="pt-2 pb-4 w-1/3">
                                            <div
                                                class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                            >
                                                Number of decks
                                            </div>
                                            <div class="flex flex-row mt-2">
                                                <label
                                                    class="block text-gray-500 font-bold w-20"
                                                    v-for="(
                                                        deck, i
                                                    ) in numberOfDecks"
                                                    :key="i"
                                                >
                                                    <input
                                                        class="mr-2 leading-tight"
                                                        type="radio"
                                                        name="card-deck"
                                                        :value="deck.id"
                                                        v-model="
                                                            formData.selectedNumberOfDecks
                                                        "
                                                        @input="
                                                            formData.errors.selectedNumberOfDecks =
                                                                ''
                                                        "
                                                    />
                                                    <span class="text-sm">
                                                        {{ deck.id }}
                                                    </span>
                                                </label>
                                            </div>
                                            <InputError
                                                :message="
                                                    formData.errors
                                                        .selectedNumberOfDecks
                                                "
                                                class="md:mt-5 mr-4"
                                                id="level-error"
                                            />
                                        </div>

                                        <div class="pt-2 pb-4 w-1/3">
                                            <label
                                                class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                                >Cards per deck</label
                                            >
                                            <VueMultiselect
                                                v-model="formData.cardQuantity"
                                                :options="cardQuantity"
                                                :multiple="false"
                                                placeholder="Select a quantity"
                                                :close-on-select="true"
                                                @select="
                                                    formData.errors.cardQuantity =
                                                        ''
                                                "
                                            >
                                            </VueMultiselect>
                                            <InputError
                                                :message="
                                                    formData.errors.cardQuantity
                                                "
                                                class="mt-2"
                                                id="level-error"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-6" />

                                <div class="flex flex-col">
                                    <div
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-6"
                                    >
                                        Step 3: Select the categories and word
                                        lists to populate the cards in your
                                        game.
                                    </div>
                                    <div class="flex flex-row px-12">
                                        <div
                                            class="w-1/3 px-3 mb-6 md:mb-0 flex flex-col gap-2"
                                        >
                                            <div
                                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-2"
                                            >
                                                Deck 1
                                            </div>
                                            <div class="mb-2">
                                                <label
                                                    class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                                    >List Category</label
                                                >
                                                <VueMultiselect
                                                    v-model="
                                                        formData.cardDeck1
                                                            .category
                                                    "
                                                    :options="categories"
                                                    :multiple="false"
                                                    placeholder="Select one"
                                                    label="name"
                                                    track-by="id"
                                                    :close-on-select="true"
                                                    @select="
                                                        formData.errors[
                                                            'cardDeck1.category'
                                                        ] = ''
                                                    "
                                                >
                                                </VueMultiselect>
                                                <InputError
                                                    :message="
                                                        formData.errors[
                                                            'cardDeck1.category'
                                                        ]
                                                    "
                                                    class="mt-2"
                                                    id="level-error"
                                                />
                                            </div>
                                            <div class="mb-2">
                                                <label
                                                    class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                                    >List Name</label
                                                >
                                                <VueMultiselect
                                                    v-model="
                                                        formData.cardDeck1.list
                                                    "
                                                    :options="
                                                        filterListsByLevelAndCategory(
                                                            formData.level,
                                                            formData.cardDeck1
                                                                .category
                                                        )
                                                    "
                                                    :multiple="true"
                                                    placeholder="Select one or more"
                                                    label="name"
                                                    track-by="id"
                                                    :close-on-select="false"
                                                    @select="
                                                        handleSelectAll(
                                                            $event,
                                                            'cardDeck1'
                                                        )
                                                    "
                                                    @remove="
                                                        handleRemoveAll(
                                                            $event,
                                                            'cardDeck1'
                                                        )
                                                    "
                                                >
                                                </VueMultiselect>
                                                <InputError
                                                    :message="
                                                        formData.errors[
                                                            'cardDeck1.list'
                                                        ]
                                                    "
                                                    class="mt-2"
                                                    id="level-error"
                                                />
                                            </div>
                                        </div>

                                        <div
                                            v-if="
                                                formData.selectedNumberOfDecks >
                                                1
                                            "
                                            class="w-1/3 px-3 mb-6 md:mb-0 flex flex-col gap-2"
                                        >
                                            <div
                                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-2"
                                            >
                                                Deck 2
                                            </div>
                                            <div class="mb-2">
                                                <label
                                                    class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                                    >List Category</label
                                                >
                                                <VueMultiselect
                                                    v-model="
                                                        formData.cardDeck2
                                                            .category
                                                    "
                                                    :options="categories"
                                                    :multiple="false"
                                                    placeholder="Select one"
                                                    label="name"
                                                    track-by="id"
                                                    :close-on-select="true"
                                                    @select="
                                                        formData.errors[
                                                            'cardDeck2.category'
                                                        ] = ''
                                                    "
                                                >
                                                </VueMultiselect>
                                                <InputError
                                                    :message="
                                                        formData.errors[
                                                            'cardDeck2.category'
                                                        ]
                                                    "
                                                    class="mt-2"
                                                    id="level-error"
                                                />
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
                                                    :multiple="true"
                                                    placeholder="Select one or more"
                                                    label="name"
                                                    track-by="id"
                                                    :close-on-select="false"
                                                    @select="
                                                        handleSelectAll(
                                                            $event,
                                                            'cardDeck2'
                                                        )
                                                    "
                                                    @remove="
                                                        handleRemoveAll(
                                                            $event,
                                                            'cardDeck2'
                                                        )
                                                    "
                                                >
                                                </VueMultiselect>
                                                <InputError
                                                    :message="
                                                        formData.errors[
                                                            'cardDeck2.list'
                                                        ]
                                                    "
                                                    class="mt-2"
                                                    id="level-error"
                                                />
                                            </div>
                                        </div>

                                        <div
                                            v-if="
                                                formData.selectedNumberOfDecks >
                                                2
                                            "
                                            class="w-1/3 px-3 mb-6 md:mb-0 flex flex-col gap-2"
                                        >
                                            <div
                                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-2"
                                            >
                                                Deck 3
                                            </div>
                                            <div class="mb-2">
                                                <label
                                                    class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                                    >List Category</label
                                                >
                                                <VueMultiselect
                                                    v-model="
                                                        formData.cardDeck3
                                                            .category
                                                    "
                                                    :options="categories"
                                                    :multiple="false"
                                                    placeholder="Select one"
                                                    label="name"
                                                    track-by="id"
                                                    :close-on-select="true"
                                                    @select="
                                                        formData.errors[
                                                            'cardDeck3.category'
                                                        ] = ''
                                                    "
                                                >
                                                </VueMultiselect>
                                                <InputError
                                                    :message="
                                                        formData.errors[
                                                            'cardDeck3.category'
                                                        ]
                                                    "
                                                    class="mt-2"
                                                    id="level-error"
                                                />
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
                                                    :multiple="true"
                                                    placeholder="Select one or more"
                                                    label="name"
                                                    track-by="id"
                                                    :close-on-select="false"
                                                    @select="
                                                        handleSelectAll(
                                                            $event,
                                                            'cardDeck3'
                                                        )
                                                    "
                                                    @remove="
                                                        handleRemoveAll(
                                                            $event,
                                                            'cardDeck3'
                                                        )
                                                    "
                                                >
                                                </VueMultiselect>
                                                <InputError
                                                    :message="
                                                        formData.errors[
                                                            'cardDeck3.list'
                                                        ]
                                                    "
                                                    class="mt-2"
                                                    id="level-error"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-6" />

                                <div class="flex flex-col gap-4">
                                    <div
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    >
                                        Step 4: Select any additional options
                                    </div>
                                    <div class="flex flex-row gap-4 px-12">
                                        <label
                                            class="inline-flex items-center me-5 cursor-pointer"
                                            :class="
                                                formData.showStopwatch
                                                    ? 'opacity-50 pointer-events-none'
                                                    : ''
                                            "
                                        >
                                            <input
                                                type="checkbox"
                                                value=""
                                                class="sr-only peer"
                                                v-model="formData.showTimer"
                                            />
                                            <div
                                                class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-yellow-300 dark:peer-focus:ring-yellow-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-yellow-400"
                                            ></div>
                                            <span
                                                class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"
                                                >Use timer</span
                                            >
                                        </label>

                                        <label
                                            class="inline-flex items-center me-5 cursor-pointer"
                                        >
                                            <input
                                                type="checkbox"
                                                value=""
                                                class="sr-only peer"
                                                v-model="formData.showDice"
                                            />
                                            <div
                                                class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-yellow-300 dark:peer-focus:ring-yellow-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-yellow-400"
                                            ></div>
                                            <span
                                                class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"
                                                >Use dice</span
                                            >
                                        </label>
                                        <label
                                            class="inline-flex items-center me-5 cursor-pointer"
                                            :class="
                                                formData.showTimer
                                                    ? 'opacity-50 pointer-events-none'
                                                    : ''
                                            "
                                        >
                                            <input
                                                type="checkbox"
                                                value=""
                                                class="sr-only peer"
                                                v-model="formData.showStopwatch"
                                            />
                                            <div
                                                class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-yellow-300 dark:peer-focus:ring-yellow-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-yellow-400"
                                            ></div>
                                            <span
                                                class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"
                                                >Use stopwatch</span
                                            >
                                        </label>
                                    </div>
                                </div>
                                <hr class="my-6" />
                                <div class="flex flex-row justify-end">
                                    <PrimaryButton
                                        type="submit"
                                        class="px-12 mb-6 md:mb-0"
                                        >Start Game
                                    </PrimaryButton>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
<style>
.multiselect__content-wrapper {
    position: relative;
}

/* .multiselect__option--highlight.multiselect__option {
    background: #e3a00a !important;
} */

input[type="checkbox"]:checked,
[type="radio"]:checked,
.dark [type="checkbox"]:checked,
.dark [type="radio"]:checked {
    border-color: #e3a00a;
    background-color: #e3a00a;
}

input[type="checkbox"]:checked:hover,
[type="checkbox"]:checked:focus,
[type="radio"]:checked:hover,
[type="radio"]:checked:focus {
    border-color: #e3a00a;
    background-color: #e3a00a;
}

input[type="checkbox"]:focus,
[type="radio"]:focus {
    --tw-ring-color: #e3a00a;
}

.multiselect__tag {
    background: #e3a00a !important;
}

.multiselect__tag-icon::after {
    color: #8a6719;
}
</style>
