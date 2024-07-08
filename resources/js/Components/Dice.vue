<template>
    <div class="dice-wrapper">
        <div id="roll">
            <button
                @click="rollDice"
                type="button"
                class="flex w-50 justify-center rounded-md bg-[#BD52A8] px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-[#e86998] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 ml-6 mr-6"
            >
                Roll dice!
            </button>
        </div>
        <div class="container">
            <div id="dice2" :class="['dice', diceClass]">
                <div id="dice-two-side-one" class="side one">
                    <div class="dot one-1"></div>
                </div>
                <div id="dice-two-side-two" class="side two">
                    <div class="dot two-1"></div>
                    <div class="dot two-2"></div>
                </div>
                <div id="dice-two-side-three" class="side three">
                    <div class="dot three-1"></div>
                    <div class="dot three-2"></div>
                    <div class="dot three-3"></div>
                </div>
                <div id="dice-two-side-four" class="side four">
                    <div class="dot four-1"></div>
                    <div class="dot four-2"></div>
                    <div class="dot four-3"></div>
                    <div class="dot four-4"></div>
                </div>
                <div id="dice-two-side-five" class="side five">
                    <div class="dot five-1"></div>
                    <div class="dot five-2"></div>
                    <div class="dot five-3"></div>
                    <div class="dot five-4"></div>
                    <div class="dot five-5"></div>
                </div>
                <div id="dice-two-side-six" class="side six">
                    <div class="dot six-1"></div>
                    <div class="dot six-2"></div>
                    <div class="dot six-3"></div>
                    <div class="dot six-4"></div>
                    <div class="dot six-5"></div>
                    <div class="dot six-6"></div>
                </div>
            </div>
        </div>

        <div>
            <p class="dice-text">{{ diceText }}</p>
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from "vue";

const diceClass = ref("dice-two");

const options = [
    { id: 1, option: "Options1" },
    { id: 2, option: "Options2" },
    { id: 3, option: "Options3" },
];

const options1 = [
    { id: 1, option: "Make a positive sentence!" },
    { id: 2, option: "Make a negative sentence!" },
    { id: 3, option: "Make a question!" },
];

const diceText = computed(() => {
    if (
        diceClass.value.includes("show-1") ||
        diceClass.value.includes("show-2")
    ) {
        return "Make a positive sentence!";
    }
    if (
        diceClass.value.includes("show-3") ||
        diceClass.value.includes("show-4")
    ) {
        return "Make a negative sentence!";
    }
    if (
        diceClass.value.includes("show-5") ||
        diceClass.value.includes("show-6")
    ) {
        return "Make a question!";
    }
    return "Roll the dice!";
});

const rollDice = () => {
    const diceTwo = Math.floor(Math.random() * 6 + 1);
    diceClass.value = "dice-two show-" + diceTwo;

    for (let k = 1; k <= 6; k++) {
        if (diceClass.value.includes("show-" + k)) {
            diceClass.value.replace("show-" + k, "");
        }
    }

    for (let k = 1; k <= 6; k++) {
        if (diceTwo === k) {
            diceClass.value = "show-" + k;
            return;
        }
    }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<style scoped>
.dice-wrapper {
    position: relative;
    height: 100%;
    width: 100%;
    padding-left: 400px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
}

.container {
    position: relative;
    display: inline-block;
    width: 50px;
}

.dice {
    position: relative;
    width: 100px;
    height: 50px;
    transform-style: preserve-3d;
    transition: transform 1s;
}

.dot {
    position: absolute;
    width: 10px;
    height: 10px;
    margin: -5px 2.5px 2.5px -5px;
    border-radius: 20px;
    background-color: #e86998;
    box-shadow: inset 2px 2px #bd52a8;
}

/* .dice-one {
    position: absolute;
    left: 150px;
} */

/* .dice-two {
    position: absolute;
    top: 30px;
    left: 250px;
} */

.side {
    position: absolute;
    background-color: #f9e4b3;
    border-radius: 5px;
    width: 50px;
    height: 50px;
    border: 1px solid #e5e5e5;
    text-align: center;
    line-height: 2em;
}

.side:nth-child(1) {
    transform: translateZ(1.5em);
}

.side:nth-child(6) {
    transform: rotateY(90deg) translateZ(1.5em);
}

.side:nth-child(3) {
    transform: rotateY(-90deg) translateZ(1.5em);
}

.side:nth-child(4) {
    transform: rotateX(90deg) translateZ(1.5em);
}

.side:nth-child(5) {
    transform: rotateX(-90deg) translateZ(1.5em);
}

.side:nth-child(2) {
    transform: rotateY(-180deg) translateZ(1.5em);
}

.show-1 {
    transform: rotateX(720deg) rotateZ(-720deg);
}

.show-2 {
    transform: rotateX(-900deg) rotateZ(1080deg);
}

.show-6 {
    transform: rotateY(-450deg) rotateZ(-1440deg);
}

.show-3 {
    transform: rotateY(810deg) rotateZ(720deg);
}

.show-4 {
    transform: rotateX(-810deg) rotateZ(-1080deg);
}

.show-5 {
    transform: rotateX(450deg) rotateZ(-720deg);
}

.two-1,
.three-1,
.four-1,
.five-1,
.six-1 {
    top: 20%;
    left: 20%;
}

.four-3,
.five-3,
.six-4 {
    top: 20%;
    left: 80%;
}

.one-1,
.three-2,
.five-5 {
    top: 50%;
    left: 50%;
}

.four-2,
.five-2,
.six-3 {
    top: 80%;
    left: 20%;
}

.two-2,
.three-3,
.four-4,
.five-4,
.six-6 {
    top: 80%;
    left: 80%;
}

.six-2 {
    top: 50%;
    left: 20%;
}

.six-5 {
    top: 50%;
    left: 80%;
}

.dice-text {
    font-size: 1.3rem;
    font-weight: 600;
    text-align: center;
    padding-right: 10px;
}

/* #roll {
    position: relative;
    display: flex;
    justify-content: center;
} */
</style>
