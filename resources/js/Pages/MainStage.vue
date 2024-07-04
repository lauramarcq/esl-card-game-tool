<template>
    <AuthenticatedLayout>
        <Head title="Game" />
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-40">
                <div class="bg-white shadow-sm sm:rounded-lg mb-2 min-h-40">
                    <div class="game-top"><Dice v-if="showDice" /></div>
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
                            <div
                                v-if="showTimer"
                                class="flex flex-col items-center justify-center w-1/2"
                            >
                                <InputLabel
                                    for="set_timer"
                                    value="Set time in seconds and press start"
                                    class="mt-4"
                                ></InputLabel>
                                <TextInput
                                    id="set_timer"
                                    ref="setTimerInput"
                                    v-model="animationDuration"
                                    type="text"
                                    class="w-1/2 h-10"
                                    @input="
                                        animationDuration = $event.target.value
                                    "
                                ></TextInput>
                            </div>
                            <Hourglass
                                :animationDuration="animationDuration"
                                v-if="showHourglass"
                            />
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
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Dice from "@/Components/Dice.vue";
import { Head } from "@inertiajs/vue3";
import { reactive, ref, onMounted } from "vue";

export default {
    name: "MainStage",
    components: {
        SingleCard,
        AuthenticatedLayout,
        Head,
        Hourglass,
        InputLabel,
        TextInput,
        Dice,
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
        cardQuantity: {
            type: Number,
            required: true,
        },
        level: {
            type: Object,
            required: true,
        },
        showTimer: {
            type: Boolean,
            required: true,
        },
        showDice: {
            type: Boolean,
            required: true,
        },
    },
    setup(props) {
        const stack1Cards = ref([]);
        const stack2Cards = ref([]);
        const stack3Cards = ref([]);
        let triggerClick = ref(false);
        let animationDuration = ref(0); // duration in seconds
        let showHourglass = ref(false);
        let showDice = props.showDice;
        const cardQuantity = props.cardQuantity;

        onMounted(() => {
            const deck1 = [...props.cardDeck1List].map((item) => ({
                ...item,
                flipped: false,
            }));

            stack1Cards.value = deck1
                .sort(() => 0.5 - Math.random())
                .slice(0, cardQuantity);

            if (props.cardDecks > 1) {
                const deck2 = [...props.cardDeck2List].map((item) => ({
                    ...item,
                    flipped: false,
                }));
                stack2Cards.value = deck2
                    .sort(() => 0.5 - Math.random())
                    .slice(0, cardQuantity);
            }
            if (props.cardDecks > 2) {
                const deck3 = [...props.cardDeck3List].map((item) => ({
                    ...item,
                    flipped: false,
                }));
                stack3Cards.value = deck3
                    .sort(() => 0.5 - Math.random())
                    .slice(0, cardQuantity);
            }
        });

        function handleStartGameButtonClick() {
            triggerClick.value = !triggerClick.value;
            if (props.showTimer && animationDuration.value > 0) {
                showHourglass.value = true;
            }
        }

        function handleButtonStop() {
            triggerClick.value = !triggerClick.value;
            showHourglass.value = false;
            const input = document.getElementById("set_timer");
            input.value = 0;
        }

        return {
            stack1Cards,
            stack2Cards,
            stack3Cards,
            triggerClick,
            animationDuration,
            showHourglass,
            showDice,
            cardQuantity,
            handleStartGameButtonClick,
            handleButtonStop,
        };
    },
};
</script>

<style>
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
    max-width: 50%;
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
    height: 15vh;
}
</style>
