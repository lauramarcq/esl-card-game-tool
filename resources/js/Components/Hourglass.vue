<template>
    <div class="hourglass-container">
        <svg
            version="1.1"
            id="Layer_1"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0"
            y="0"
            viewBox="0 0 100 100"
            xml:space="preserve"
        >
            <path
                id="body"
                d="M69.2 61.9c-5.6-6.7-14.5-10.2-14-14.6.8-3.9 8.8-7.4 13.9-13.5 5.7-6.8 4.7-15.5 4.3-17.6H26.3S24 26.6 30.5 34.3c5.6 6.7 14.5 10.2 14 14.6-.8 3.9-8.8 7.4-13.9 13.5-5.7 6.8-4.7 15.5-4.3 17.6h47.2c-.1 0 2.2-10.4-4.3-18.1z"
                fill="#FFF2E6"
            />
            <path
                id="stand-down"
                class="st2"
                d="M76.5 16H23.1c-2.8 0-5.2-2.3-5.2-5.2 0-2.8 2.3-5.2 5.2-5.2h53.4c2.8 0 5.2 2.3 5.2 5.2 0 2.9-2.3 5.2-5.2 5.2z"
            />
            <path
                id="stand-top"
                class="st2"
                d="M76.5 90.3H23.1c-2.8 0-5.2-2.3-5.2-5.2 0-2.8 2.3-5.2 5.2-5.2h53.4c2.8 0 5.2 2.3 5.2 5.2 0 2.9-2.3 5.2-5.2 5.2z"
            />

            <g id="up">
                <defs>
                    <path
                        id="cp-up"
                        d="M32.8 27.8c2.3 6.1 16.6 16 17.1 17.8.5-1.7 14.8-11.7 17.1-17.8 1.9-5-4.3-4.3-4.3-4.3H37.1s-6.2-.7-4.3 4.3z"
                    />
                </defs>
                <clipPath id="clippathup">
                    <use xlink:href="#cp-up" overflow="hidden" />
                </clipPath>
            </g>
            <g id="sand-container-up" clip-path="url(#clippathup)">
                <path id="sand-up" fill="#ff9811" d="M32 23h36v23H32z" />
            </g>

            <g id="down">
                <defs>
                    <path
                        id="cp-down"
                        d="M66.9 70.5c-2.3-6.1-16.6-16-17.1-17.8-.5 1.7-14.8 11.7-17.1 17.8-1.9 5 4.3 4.3 4.3 4.3h25.6s6.2.7 4.3-4.3z"
                    />
                </defs>
                <clipPath id="clippathdown">
                    <use xlink:href="#cp-down" />
                </clipPath>
            </g>
            <g id="sand-container-down" clip-path="url(#clippathdown)">
                <path
                    id="sand-down"
                    fill="#ff9811"
                    d="M32.4 75h34.8v21.8H32.4z"
                />
            </g>

            <g id="stream">
                <path
                    class="st4"
                    id="stream-line"
                    stroke-width="1"
                    x
                    stroke-dasharray="3,3"
                    d="M49.8 49.3v20.8"
                />
            </g>
        </svg>
    </div>
</template>

<script setup>
import { onMounted } from "vue";
const props = defineProps({
    animationDuration: {
        type: Number,
        default: 5,
    },
});

onMounted(() => {
    setTimeout(() => {
        const hourglassContainer = document.querySelector(
            ".hourglass-container"
        );
        hourglassContainer.classList.add("blink");
        setTimeout(() => {
            hourglassContainer.classList.remove("blink");
        }, 8000);
    }, props.animationDuration * 1000);
});

document.documentElement.style.setProperty(
    "--animation-duration",
    `${props.animationDuration}s`
);
</script>

<style lang="scss">
// :root {
//     --animation-duration: 0;
// }
.hourglass-container {
    height: 150px;
    width: 150px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    align-content: center;
}

svg {
    max-width: 150px;
}
.st2 {
    fill: #e86998;
}
.st4 {
    fill: none;
    stroke: #ff9811;
    stroke-width: 1;
    // stroke-linecap: round;
    stroke-miterlimit: 5;
}
#stream-line {
    animation: disappear var(--animation-duration) linear forwards;
    transform: translateY(-1px);
}
#stream {
    animation: shift 0.2s linear infinite;
}
#sand-up {
    transform: translateY(0px);
    animation: drainSand var(--animation-duration) ease-in-out forwards;
}
#sand-down {
    transform: translateY(0px);
    animation: fillSand var(--animation-duration) ease-in-out forwards;
}

@keyframes shift {
    0% {
        transform: translateY(-1px);
    }
    100% {
        transform: translateY(0px);
    }
}

@keyframes disappear {
    0% {
        transform: translateY(0px);
    }
    97% {
        transform: translateY(0px);
    }
    99% {
        transform: translateY(4.5px);
    }
    100% {
        transform: scaleY(0);
    }
}

@keyframes fillSand {
    to {
        transform: translateY(-22px);
    }
}
@keyframes drainSand {
    to {
        transform: translateY(23px);
    }
}

.blink {
    animation: blink 2s linear infinite;
}

@keyframes blink {
    0% {
        opacity: 0;
    }
    50% {
        opacity: 1;
    }
}
</style>
