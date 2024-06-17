<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Dropdown from "@/Components/Dropdown.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, router } from "@inertiajs/vue3";
import ListTable from "@/Components/ListTable.vue";
import { ref, computed } from "vue";

const availableLists = ref([
    { name: "Subjects" },
    { name: "Predicates" },
    { name: "Time Phrases" },
]);

defineProps({
    subjects: Object,
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

const levels = ref(["A1", "A2", "B1", "B2", "C1", "C2"]);

const subjectOptions = ref([
    { name: "Select All", value: "" },
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
    { name: "Select All", value: "" },
    { name: "Past", value: "is_past" },
    { name: "Present", value: "is_present" },
    { name: "Future", value: "is_future" },
    { name: "Perfect", value: "is_perfect" },
    { name: "Continuous", value: "is_continous" },
    { name: "Perfect Continous", value: "is_perfect_continous" },
]);

const predicatesOptions = ref([
    { name: "Select All", value: "" },
    { name: "Single word", value: "is_phrase" },
    { name: "Phrase", value: "is_phrase" },
]);
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
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2"
                >
                    <div class="p-6 text-gray-900">
                        <h3
                            class="font-semibold text-lg text-gray-800 leading-tight"
                        >
                            Select to set up card game
                        </h3>
                        <form action="post">
                            <div class="form-inputs mt-4">
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grid-state"
                                    >
                                        Level
                                    </label>
                                    <div class="relative">
                                        <select
                                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-state"
                                        >
                                            <option
                                                v-for="(level, index) in levels"
                                                :key="index"
                                            >
                                                {{ level }}
                                            </option>
                                        </select>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                                        >
                                            <!-- <svg
                                                class="fill-current h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                                />
                                            </svg> -->
                                        </div>
                                    </div>
                                    <div
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-6"
                                    >
                                        Number of card decks
                                    </div>
                                    <div
                                        class="md:flex md:items-center mb-6 mt-2"
                                    >
                                        <label
                                            class="md:w-2/3 block text-gray-500 font-bold"
                                        >
                                            <input
                                                class="mr-2 leading-tight"
                                                type="radio"
                                                name="card-deck"
                                                value="2"
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
                                            />
                                            <span class="text-sm"> 3 </span>
                                        </label>
                                    </div>
                                    <div
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-6"
                                    >
                                        Lists to use
                                    </div>
                                    <div class="subjects-dropdown mt-4">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-state"
                                        >
                                            Subjects
                                        </label>
                                        <div class="relative">
                                            <select
                                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                id="grid-state"
                                            >
                                                <option
                                                    v-for="(
                                                        options, key
                                                    ) in subjectOptions"
                                                    :key="key"
                                                >
                                                    {{ options.name }}
                                                </option>
                                            </select>
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                                            ></div>
                                        </div>
                                    </div>

                                    <div class="time-phrases-dropdown mt-4">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-state"
                                        >
                                            Time Phrases
                                        </label>
                                        <div class="relative">
                                            <select
                                                multitple
                                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                id="grid-state"
                                            >
                                                <option
                                                    v-for="(
                                                        options, key
                                                    ) in timePhrasesOptions"
                                                    :key="key"
                                                >
                                                    {{ options.name }}
                                                </option>
                                            </select>
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                                            ></div>
                                        </div>
                                    </div>

                                    <div class="predicates-dropdown mt-4">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-state"
                                        >
                                            Predicates
                                        </label>
                                        <div class="relative">
                                            <select
                                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                id="grid-state"
                                            >
                                                <option
                                                    v-for="(
                                                        options, key
                                                    ) in predicatesOptions"
                                                    :key="key"
                                                >
                                                    {{ options.name }}
                                                </option>
                                            </select>
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                                            ></div>
                                        </div>
                                    </div>
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
