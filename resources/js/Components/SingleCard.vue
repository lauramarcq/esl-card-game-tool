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
    </div>
</template>

<script>
import { watch, toRefs, ref } from "vue";

export default {
    name: "SingleCard",
    props: {
        cardsSelected: Array,
        triggerClick: Boolean,
        nextCardClick: Event,
        previousCardClick: Event,
    },
    setup(props) {
        const {
            triggerClick,
            cardsSelected,
            nextCardClick,
            previousCardClick,
        } = toRefs(props);
        const currentCardIndex = ref(0);

        watch(triggerClick, (newVal, oldVal) => {
            if (oldVal !== newVal) {
                handleClick();
            }
        });

        watch(nextCardClick, (newVal, oldVal) => {
            if (oldVal !== newVal) {
                nextCard();
            }
        });

        watch(previousCardClick, (newVal, oldVal) => {
            if (oldVal !== newVal) {
                previousCard();
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
            }, 600);

            setTimeout(() => {
                if (currentCardIndex.value < cardsSelected.value.length - 1) {
                    currentCardIndex.value++;
                }
            }, 700);
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
            }, 600);

            setTimeout(() => {
                if (currentCardIndex.value > 0) {
                    currentCardIndex.value--;
                }
            }, 600);
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
    transform: rotatey(-160deg);
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
