<template>
    <!-- <link
        href="https://unpkg.com/@primer/css@^20.2.4/dist/primer.css"
        rel="stylesheet"
    /> -->
    <div class="container">
        <section class="time-container">
            <p class="time">
                <span>{{ seconds }}</span
                >:<span>{{ tens }}</span>
            </p>
        </section>

        <section title="actions" class="stopwatch-button-container">
            <button
                :class="
                    running
                        ? 'text-blue-500 font-bold hover:text-blue-700'
                        : 'text-green-500 font-bold hover:text-green-700'
                "
                @click="startStop"
            >
                <span>{{ running ? "Pause" : "Start" }}</span>
            </button>
            <button
                class="text-red-500 font-bold hover:text-red-700"
                @click="reset"
            >
                Reset
            </button>
        </section>
    </div>
</template>

<script setup>
import { ref, defineExpose } from "vue";

const props = defineProps({});

let tens = ref("00");
let seconds = ref("00");
let interval;
let running = ref(false);

const startStop = () => {
    if (!running.value) {
        running.value = true;
        interval = setInterval(startTimer, 10);
    } else {
        pause();
    }
};

const pauseTimer = () => {
    running.value = false;
    clearInterval(interval);
};

const reset = () => {
    clearInterval(interval);
    running.value = false;
    tens.value = "00";
    seconds.value = "00";
};

const startTimer = () => {
    let numTens = parseInt(tens.value);
    let numSeconds = parseInt(seconds.value);

    numTens++;
    if (numTens <= 9) {
        tens.value = "0" + numTens;
    }

    if (numTens > 9) {
        tens.value = numTens;
    }

    if (numTens > 99) {
        numSeconds++;
        seconds.value = "0" + numSeconds;
        numTens = 0;
        tens.value = "0" + numTens;
    }

    if (numSeconds > 9) {
        seconds.value = numSeconds;
    }
};

defineExpose({ startStop, reset, pauseTimer });
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap");

.container {
    display: flex;
    flex-direction: column;
    width: fit-content;
    gap: 10px;
    padding: 20px;
    /* background-color: #f9e4b3;
    border: 1px solid #e5e5e5;
    border-radius: 5px; */
}

.time {
    font-size: 40px;
    font-family: "Share Tech Mono", monospace;
    text-align: center;
}

.stopwatch-button-container {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-self: center;
    gap: 20px;
}

.time-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
</style>
