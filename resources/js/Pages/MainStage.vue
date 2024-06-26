<template>
    <AuthenticatedLayout>
        <Head title="Game" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ gameType.subtitle }}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg mb-2">
                    <div class="game-top">
                        <div class="w-7xl px-4 py-6 sm:px-6 lg:px-8">
                            <h1 class="text-3xl font-bold text-gray-900">
                                {{ gameType.title }}
                            </h1>
                            <h3>{{ gameType.subtitle }}</h3>
                        </div>
                        <div class="explanation-container">
                            <p>
                                {{ gameType.description }}
                            </p>
                            <p class="example">(+) {{ gameType.example }}</p>
                        </div>
                    </div>
                    <div class="stage-container">
                        <div class="button-area">
                            <button
                                v-if="!triggerClick"
                                @click="handleGameButtonClick"
                                type="button"
                                class="flex w-1/2 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 ml-6 mr-6"
                            >
                                Start!
                            </button>
                            <button
                                v-else
                                @click="triggerClick = !triggerClick"
                                type="button"
                                class="flex w-1/2 justify-center rounded-md bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
                            >
                                Stop
                            </button>
                            <!-- <div class="stack-buttons">
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
                            </div> -->
                            <div class="dice-area"></div>

                            <Hourglass />
                        </div>
                        <div class="card-area">
                            <div class="deck1-cards">
                                <SingleCard
                                    class="stack-1"
                                    :cardsSelected="stack1Cards"
                                    :triggerClick="triggerClick"
                                ></SingleCard>
                            </div>
                            <div class="deck2-cards" v-if="cardDecks > 1">
                                <SingleCard
                                    class="stack-2"
                                    :cardsSelected="stack2Cards"
                                    :triggerClick="triggerClick"
                                ></SingleCard>
                            </div>
                            <div class="deck3-cards" v-if="cardDecks > 2">
                                <SingleCard
                                    class="stack-3"
                                    :cardsSelected="stack3Cards"
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
import Hourglass from "@/Components/Hourglass.vue";
import { Head } from "@inertiajs/vue3";
import { reactive, ref, onMounted } from "vue";

export default {
    name: "MainStage",
    components: {
        SingleCard,
        AuthenticatedLayout,
        Head,
        Hourglass,
    },
    props: {
        gameType: {
            type: Object,
            required: true,
        },
        cardDeck1Category: {
            type: Object,
            required: true,
        },
        cardDeck2Category: {
            type: Object,
            required: false,
        },
        cardDeck3Category: {
            type: Object,
            required: false,
        },
        cardDeck1List: {
            type: Object,
            required: true,
        },
        cardDeck2List: {
            type: Object,
            required: false,
        },
        cardDeck3List: {
            type: Object,
            required: false,
        },
        cardDecks: {
            type: Number,
            required: true,
        },
        level: {
            type: Object,
            required: true,
        },
    },
    setup(props) {
        const stack1Cards = ref([]);
        const stack2Cards = ref([]);
        const stack3Cards = ref([]);
        let startTime = ref(null);
        let elapsedTime = ref(0);
        let timerInterval = ref(null);
        let triggerClick = ref(false);

        onMounted(() => {
            const deck1 = [...props.cardDeck1List.list_items].map((item) => ({
                ...item,
                flipped: false,
            }));

            stack1Cards.value = deck1
                .sort(() => 0.5 - Math.random())
                .slice(0, 6);

            if (props.cardDecks > 1) {
                const deck2 = [...props.cardDeck2List.list_items].map(
                    (item) => ({ ...item, flipped: false })
                );
                stack2Cards.value = deck2
                    .sort(() => 0.5 - Math.random())
                    .slice(0, 6);
            }
            if (props.cardDecks > 2) {
                const deck3 = [...props.cardDeck3List.list_items].map(
                    (item) => ({ ...item, flipped: false })
                );
                stack3Cards.value = deck3
                    .sort(() => 0.5 - Math.random())
                    .slice(0, 6);
            }
        });

        // function startTimer() {
        //     startTime = Date.now() - elapsedTime;
        //     timerInterval = setInterval(updateTimer, 10);
        //     console.log(timerInterval, startTime);
        // }

        // function updateTimer() {
        //     const currentTime = Date.now();
        //     elapsedTime = currentTime - startTime;
        // }

        // function resetTimer() {
        //     clearInterval(timerInterval);
        //     startTime = null;
        //     elapsedTime = 0;
        // }

        // function stopTimer() {
        //     clearInterval(timerInterval);
        // }

        function handleGameButtonClick() {
            triggerClick.value = !triggerClick.value;
            // if (triggerClick.value === true) {
            //     startTimer();
            // }
            // if (triggerClick.value === false) {
            //     stopTimer();
            // }
        }

        return {
            stack1Cards,
            stack2Cards,
            stack3Cards,
            triggerClick,
            handleGameButtonClick,
            // startTimer,
            // stopTimer,
            // resetTimer,
            // updateTimer,
            startTime,
            elapsedTime,
            timerInterval,
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
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 50px;
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

.deck1-cards,
.deck2-cards,
.deck3-cards {
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
    padding-left: 2rem;
    padding-right: 2rem;
}
</style>
