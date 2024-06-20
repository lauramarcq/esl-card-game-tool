<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import VueMultiselect from "vue-multiselect";
import { Head, router, useForm } from "@inertiajs/vue3";
import ListTable from "@/Components/ListTable.vue";
import { ref } from "vue";

defineProps({
    subjects: Object,
});

const availableLists = ref([
    { name: "Subjects" },
    { name: "Predicates" },
    { name: "Time Phrases" },
]);

const formData = useForm({
    levels: [],
    selectedNumberOfDecks: null,
    subjectOptions: [],
    predicatesOptions: [],
    timePhrasesOptions: [],
    errors: {
        name: null,
        price: null,
    },
});

const handleListEdit = (list) => {
    switch (list) {
        case "Subjects":
            router.get("/subject", {});
            break;
        case "Predicates":
            console.log("Predicates");
            router.get("/predicates", {});
            break;
        case "Time Phrases":
            console.log("Time Phrases");
            router.get("/time-phrases", {});
            break;
    }
};

const levels = ref([
    { name: "A1", value: "A1" },
    { name: "A2", value: "A2" },
    { name: "B1", value: "B1" },
    { name: "B2", value: "B2" },
    { name: "C1", value: "C1" },
    { name: "C2", value: "C2" },
]);

const subjectOptions = ref([
    { name: "Select All", value: "all" },
    { name: "Plurals", value: "is_plural" },
    { name: 'Beginning with article "a"', value: "begins_with_article_a" },
    { name: 'Beginning with article "an"', value: "begins_with_article_an" },
    { name: 'Beginning with article "the"', value: "begins_with_article_the" },
    { name: "People", value: "is_people" },
    { name: "Animals", value: "is_animal" },
    { name: "Places", value: "is_place" },
    { name: "Things", value: "is_thing" },
]);

const timePhrasesOptions = ref([
    { name: "Select All", value: "all" },
    { name: "Past", value: "past" },
    { name: "Present", value: "present" },
    { name: "Future", value: "future" },
    { name: "Perfect", value: "perfect" },
    { name: "Continuous", value: "continuous" },
    { name: "Perfect Continous", value: "perfect_continuous" },
]);

const predicatesOptions = ref([
    { name: "Select All", value: "all" },
    { name: "Single word", value: "is_single_word" },
    { name: "Phrase", value: "is_phrase" },
]);

const handleFormSubmit = () => {
    console.log(formData);
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
                                <div class="w-1/3 px-3 mb-6 md:mb-0">
                                    <div
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    >
                                        Language Level
                                    </div>
                                    <div class="pt-4">
                                        <label
                                            class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                            >List of levels</label
                                        >
                                        <VueMultiselect
                                            v-model="formData.levels"
                                            :options="levels"
                                            :multiple="true"
                                            placeholder="Select one or more"
                                            label="name"
                                            track-by="name"
                                            :close-on-select="false"
                                        >
                                            <template
                                                #selection="{ values, isOpen }"
                                            >
                                                <span
                                                    class="multiselect__single"
                                                    v-if="values.length"
                                                    v-show="!isOpen"
                                                    >{{ values.length }} options
                                                    selected</span
                                                >
                                            </template>
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
                                    class="w-1/3 px-3 mb-6 md:mb-0 flex flex-col gap-4"
                                >
                                    <div
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    >
                                        Lists to use
                                    </div>
                                    <div>
                                        <label
                                            class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                            >List of subjects</label
                                        >
                                        <VueMultiselect
                                            v-model="formData.subjectOptions"
                                            :options="subjectOptions"
                                            :multiple="true"
                                            placeholder="Select one or more"
                                            label="name"
                                            track-by="name"
                                            :close-on-select="false"
                                        >
                                            <template
                                                #selection="{ values, isOpen }"
                                            >
                                                <span
                                                    class="multiselect__single"
                                                    v-if="values.length"
                                                    v-show="!isOpen"
                                                    >{{ values.length }} options
                                                    selected</span
                                                >
                                            </template>
                                        </VueMultiselect>
                                    </div>

                                    <div>
                                        <label
                                            class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                            >List of predicates</label
                                        >
                                        <VueMultiselect
                                            v-model="formData.predicatesOptions"
                                            :options="predicatesOptions"
                                            :multiple="true"
                                            placeholder="Select one or more"
                                            label="name"
                                            track-by="name"
                                            :close-on-select="false"
                                        >
                                            <template
                                                #selection="{ values, isOpen }"
                                            >
                                                <span
                                                    class="multiselect__single"
                                                    v-if="values.length"
                                                    v-show="!isOpen"
                                                    >{{ values.length }} options
                                                    selected</span
                                                >
                                            </template>
                                        </VueMultiselect>
                                    </div>

                                    <div>
                                        <label
                                            class="typo__label text-sm font-semibold leading-6 text-gray-900"
                                            >List of time phrases</label
                                        >
                                        <VueMultiselect
                                            v-model="
                                                formData.timePhrasesOptions
                                            "
                                            :options="timePhrasesOptions"
                                            :multiple="true"
                                            placeholder="Select one or more"
                                            label="name"
                                            track-by="name"
                                            :close-on-select="false"
                                        >
                                            <template
                                                #selection="{ values, isOpen }"
                                            >
                                                <span
                                                    class="multiselect__single"
                                                    v-if="values.length"
                                                    v-show="!isOpen"
                                                    >{{ values.length }} options
                                                    selected</span
                                                >
                                            </template>
                                        </VueMultiselect>
                                    </div>
                                </div>
                                <div
                                    class="w-1/3 px-3 mb-6 md:mb-0 flex flex-row items-end justify-end"
                                >
                                    <PrimaryButton type="submit"
                                        >Start Game
                                    </PrimaryButton>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
</style>
