<template>
    <AuthenticatedLayout>
        <Head title="Game" />
        <template #header>
            <div class="flex flex-row justify-between content-center">
                <h2 class="font-bold text-xl text-gray-800 leading-tight">
                    {{ gameType.title }}
                </h2>
                <div class="explanation-container">
                    <p>
                        {{ gameType.description }}
                    </p>
                    <p class="example">(+) {{ gameType.example }}</p>
                </div>
            </div>
        </template>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-40">
                <div class="bg-white shadow-sm sm:rounded-lg mb-2 min-h-40">
                    <div class="game-top">
                        <div></div>
                        <Dice v-if="showDice" />
                    </div>
                    <div class="stage-container">
                        <div class="button-area">
                            <button
                                v-if="!triggerClick"
                                @click="handleStartGameButtonClick"
                                type="button"
                                class="flex w-1/2 justify-center rounded-md bg-[#BD52A8] px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-[#e86998] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 ml-6 mr-6"
                            >
                                Start!
                            </button>
                            <button
                                v-else
                                @click="handleButtonStop"
                                type="button"
                                class="flex w-1/2 justify-center rounded-md bg-[#e86998] px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
                            >
                                Stop
                            </button>
                            <div class="buttons">
                                <button
                                    @click="previousCard = $event"
                                    type="button"
                                    class="inline-flex items-center rounded-md bg-[#f9e4b3] px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-[#f5c863] ml-10 disabled:bg-white"
                                >
                                    Prev.
                                </button>
                                <button
                                    @click="nextCard = $event"
                                    type="button"
                                    class="inline-flex items-center rounded-md bg-[#f9e4b3] px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-[#f5c863] disabled:opacity-50"
                                >
                                    Next
                                </button>
                            </div>
                            <div
                                v-if="showTimer"
                                class="flex flex-col items-center justify-center w-1/2"
                            >
                                <TextInput
                                    id="set_timer"
                                    ref="setTimerInput"
                                    v-model="animationDuration"
                                    placeholder="seconds"
                                    type="text"
                                    class="w-2/3 h-10"
                                    @input="
                                        animationDuration = $event.target.value
                                    "
                                ></TextInput>
                            </div>
                            <Hourglass
                                :animationDuration="Number(animationDuration)"
                                v-if="showHourglass"
                            />
                            <Stopwatch ref="stopwatch" v-if="showStopwatch" />
                        </div>
                        <div class="card-area">
                            <div class="deck1-cards">
                                <SingleCard
                                    class="stack-1"
                                    :cardsSelected="stack1Cards"
                                    :triggerClick="triggerClick"
                                    :nextCardClick="nextCard"
                                    :previousCardClick="previousCard"
                                ></SingleCard>
                            </div>
                            <div class="deck2-cards" v-if="cardDecks > 1">
                                <SingleCard
                                    class="stack-2"
                                    :cardsSelected="stack2Cards"
                                    :triggerClick="triggerClick"
                                    :nextCardClick="nextCard"
                                    :previousCardClick="previousCard"
                                ></SingleCard>
                            </div>
                            <div class="deck3-cards" v-if="cardDecks > 2">
                                <SingleCard
                                    class="stack-3"
                                    :cardsSelected="stack3Cards"
                                    :triggerClick="triggerClick"
                                    :nextCardClick="nextCard"
                                    :previousCardClick="previousCard"
                                ></SingleCard>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import SingleCard from "@/Components/SingleCard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Hourglass from "@/Components/Hourglass.vue";
import TextInput from "@/Components/TextInput.vue";
import Dice from "@/Components/Dice.vue";
import { Head } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import Stopwatch from "@/Components/Stopwatch.vue";

const props = defineProps({
    gameType: Object,
    cardDeck1Category: Object,
    cardDeck2Category: Object,
    cardDeck3Category: Object,
    cardDeck1List: Object,
    cardDeck2List: Object,
    cardDeck3List: Object,
    cardDecks: Number,
    cardQuantity: Number,
    level: Object,
    showTimer: Boolean,
    showDice: Boolean,
    showStopwatch: Boolean,
});

let stack1Cards = ref([]);
let stack2Cards = ref([]);
let stack3Cards = ref([]);
let triggerClick = ref(false);
let animationDuration = ref(null);
let showHourglass = ref(false);
let showStopwatch = ref(props.showStopwatch);
let showDice = ref(props.showDice);
let cardQuantity = ref(props.cardQuantity);
let nextCard = ref(null);
let previousCard = ref(null);
let stopwatch = ref(null);

onMounted(() => {
    const deck1 = [...props.cardDeck1List].map((item) => ({
        ...item,
        flipped: false,
    }));

    stack1Cards.value = deck1
        .sort(() => 0.5 - Math.random())
        .slice(0, cardQuantity.value);

    if (props.cardDecks > 1) {
        const deck2 = [...props.cardDeck2List].map((item) => ({
            ...item,
            flipped: false,
        }));
        stack2Cards.value = deck2
            .sort(() => 0.5 - Math.random())
            .slice(0, cardQuantity.value);
    }
    if (props.cardDecks > 2) {
        const deck3 = [...props.cardDeck3List].map((item) => ({
            ...item,
            flipped: false,
        }));
        stack3Cards.value = deck3
            .sort(() => 0.5 - Math.random())
            .slice(0, cardQuantity.value);
    }
});

const handleStartGameButtonClick = () => {
    triggerClick.value = !triggerClick.value;
    if (props.showTimer && animationDuration.value > 0) {
        showHourglass.value = true;
    }
    if (stopwatch.value) {
        stopwatch.value.startStop();
    }
};

const handleButtonStop = () => {
    if (stopwatch.value) {
        stopwatch.value.pauseTimer();
    }
    triggerClick.value = !triggerClick.value;
    showHourglass.value = false;
    const input = document.getElementById("set_timer");
    input.value = null;
};
</script>

<style>
.stage-container {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    height: 52vh;
    max-width: inherit;
    margin: 20px 20px 0 20px;
}

.button-area {
    min-width: 30%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 50px;
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
    max-width: 60%;
}

.explanation-container p {
    text-align: right;
    padding: 0 10px;
    font-size: small;
}
.explanation-container .example {
    color: grey;
}

.game-top {
    display: grid;
    grid-template-columns: 1fr 2fr;
    padding-top: 20px;
}

.game-top .sw {
    place-self: center;
}

.buttons {
    display: flex;
    justify-content: center;
    padding-top: 20px;
    padding-bottom: 20px;
}

.buttons button {
    margin: 0 10px;
}
</style>
