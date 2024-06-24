<template>
    <AuthenticatedLayout>
        <Head title="Game" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Flash Card Race
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg mb-2">
                    <div class="game-top">
                        <div class="w-7xl px-4 py-6 sm:px-6 lg:px-8">
                            <h1 class="text-3xl font-bold text-gray-900">
                                Some kind of title
                            </h1>
                            <h3>Some kind of subtitle</h3>
                        </div>
                        <div class="explanation-container">
                            <p>
                                Make sentences and questions by putting the
                                verbs in the right form!
                            </p>
                            <p class="example">
                                (+) A bear <b>sleeps</b> all day in winter
                            </p>
                        </div>
                    </div>
                    <div class="stage-container">
                        <div class="button-area">
                            <button
                                v-if="!triggerClick"
                                @click="triggerClick = !triggerClick"
                                type="button"
                                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            >
                                Start!
                            </button>
                            <button
                                v-else
                                @click="triggerClick = !triggerClick"
                                type="button"
                                class="flex w-full justify-center rounded-md bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
                            >
                                Stop
                            </button>
                            <div class="stack-buttons">
                                <button
                                    type="button"
                                    class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                >
                                    Flip Stack 1
                                </button>
                                <button
                                    type="button"
                                    class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                >
                                    Flip Stack 2
                                </button>
                                <button
                                    type="button"
                                    class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                >
                                    Flip Stack 3
                                </button>
                            </div>
                            <div class="dice-area">Dice</div>
                        </div>
                        <div class="card-area">
                            <div class="subject-cards">
                                <SingleCard
                                    class="subject"
                                    v-for="(card, i) in subjectContent"
                                    :key="i"
                                    :cardContent="subjectContent[i]"
                                    :inputId="`subject${i}`"
                                    :labelId="`subject${i}`"
                                    :triggerClick="triggerClick"
                                ></SingleCard>
                            </div>
                            <div class="verb-cards">
                                <SingleCard
                                    class="verb"
                                    v-for="(card, i) in verbContent"
                                    :key="i"
                                    :cardContent="verbContent[i]"
                                    :inputId="`verb${i}`"
                                    :labelId="`verb${i}`"
                                    :triggerClick="triggerClick"
                                ></SingleCard>
                            </div>
                            <div class="object-cards">
                                <SingleCard
                                    class="object"
                                    v-for="(card, i) in objectContent"
                                    :key="i"
                                    :cardContent="objectContent[i]"
                                    :inputId="`object${i}`"
                                    :labelId="`object${i}`"
                                    :triggerClick="triggerClick"
                                ></SingleCard>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import SingleCard from "@/Components/SingleCard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { reactive, ref } from "vue";

export default {
    name: "MainStage",
    components: {
        SingleCard,
        AuthenticatedLayout,
        Head,
    },
    setup() {
        let subjectContent = reactive(["The subject"]);
        let verbContent = reactive(["has"]);
        let objectContent = reactive(["an object"]);
        let triggerClick = ref(false);

        return {
            subjectContent,
            verbContent,
            objectContent,
            triggerClick,
        };
    },
};
</script>

<style scoped>
.stage-container {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    height: 50vh;
    max-width: inherit;
    margin: 20px;
}

.button-area {
    min-width: 30%;
    height: 100%;
    margin-top: 20%;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.stack-buttons {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    gap: 10px;
}

.card-area {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    height: 100%;
    min-width: 70%;
}

.subject-cards,
.verb-cards,
.object-cards {
    position: relative;
    top: 0;
    left: 0;
}

.explanation-container {
    padding: 0.2rem 1rem;
    border: 2px solid #f5c863;
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: fit-content;
    align-self: center;
}

.explanation-container p {
    text-align: right;
    padding: 0 10px;
}
.explanation-container .example {
    color: grey;
}

.game-top {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding-left: 4rem;
    padding-right: 2rem;
}
</style>