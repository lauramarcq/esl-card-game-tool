<template>
    <div class="playing-card">
        <input
            :id="cardsSelected[currentCardIndex]?.id"
            type="checkbox"
            @click="triggerClick"
        />
        <label :for="cardsSelected[currentCardIndex]?.id" class="card">
            <div class="card-front">
                {{ cardsSelected[currentCardIndex]?.item_value }}
            </div>
        </label>
        <div class="buttons">
            <button
                type="button"
                @click="previousCard"
                :disabled="currentCardIndex.value === 0"
                class="inline-flex items-center rounded-md bg-[#f9e4b3] px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-[#f5c863] ml-10 disabled:bg-white"
            >
                <
            </button>
            <button
                type="button"
                @click="nextCard"
                :disabled="
                    currentCardIndex.value === cardsSelected.value?.length - 1
                "
                class="inline-flex items-center rounded-md bg-[#f9e4b3] px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-[#f5c863] disabled:opacity-50"
            >
                >
            </button>
        </div>
    </div>
</template>

<script>
import { watch, toRefs, ref } from "vue";

export default {
    name: "SingleCard",
    props: {
        cardsSelected: Array,
        triggerClick: Boolean,
    },
    setup(props) {
        const { triggerClick, cardsSelected } = toRefs(props);
        const currentCardIndex = ref(0);

        watch(triggerClick, (newVal, oldVal) => {
            if (oldVal !== newVal) {
                console.log(oldVal, newVal);
                handleClick();
            }
        });

        function handleClick() {
            const card = document.getElementById(
                props.cardsSelected[currentCardIndex.value].id
            );
            card.checked = !card.checked;
        }

        function nextCard() {
            if (currentCardIndex.value === cardsSelected.value.length - 1) {
                return; // do nothing
            }

            const input = document.getElementById(
                props.cardsSelected[currentCardIndex.value].id
            );
            input.checked = !input.checked;
            setTimeout(() => {
                input.checked = true;
            }, 700);
            if (currentCardIndex.value < cardsSelected.value.length - 1) {
                currentCardIndex.value++;
            }
        }

        function previousCard() {
            if (currentCardIndex.value === 0) {
                return; // do nothing
            }
            const input = document.getElementById(
                props.cardsSelected[currentCardIndex.value].id
            );
            input.checked = !input.checked;
            setTimeout(() => {
                input.checked = true;
            }, 700);
            if (currentCardIndex.value > 0) {
                currentCardIndex.value--;
            }
        }

        return {
            handleClick,
            nextCard,
            currentCardIndex,
            cardsSelected,
            previousCard,
        };
    },
};
</script>

<style scoped>
input {
    display: none;
}

.playing-card {
    display: inline-block;
}

.playing-card label {
    position: relative;
    width: 200px;
    height: 300px;
    display: inline-block;
    padding: 20px;
    cursor: pointer;
    line-height: 1.2;
}

.playing-card label::before {
    content: "";
    display: block;
    background-image: url(../../assets/card-back.png);
    background-size: 100% 100%;
}

.playing-card label::before,
.playing-card .card-front {
    width: 200px;
    height: 300px;
    border-radius: 8px;
    transition: 1s all;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    position: absolute;
    top: 20px;
    left: 20px;
    box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3);
}

.card-front {
    background: #f9e4b3;
    position: relative;
    font-size: 29px;
    text-align: center;
    padding: 20px;
    box-sizing: border-box;
    transform: rotatey(-180deg);
    color: #444;
    display: flex;
    align-items: center;
    justify-content: center;
}

input:checked + label::before {
    transform: rotatey(-180deg);
}

input:checked + label .card-front {
    transform: rotatey(0deg);
}

.card-front::before {
    top: 0;
    left: 0;
}

.card-front::after {
    bottom: 0;
    right: 0;
    transform: rotate(180deg);
}

.buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}
</style>
