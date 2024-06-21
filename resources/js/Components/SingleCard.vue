<template>
    <div class="playing-card">
        <input :id="inputId" type="checkbox" />
        <label :for="labelId" class="card">
            <div class="card-front">{{ cardContent }}</div>
        </label>
    </div>
</template>

<script>
import { watch, toRefs } from "vue";

export default {
    name: "SingleCard",
    props: {
        cardContent: String,
        inputId: String,
        labelId: String,
        triggerClick: Boolean,
    },
    setup(props) {
        const { triggerClick } = toRefs(props);

        watch(triggerClick, (newVal, oldVal) => {
            if (oldVal !== newVal) {
                handleClick();
            }
        });

        function handleClick() {
            const card = document.getElementById(props.inputId);
            card.checked = !card.checked;
        }

        return {
            handleClick,
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
</style>
