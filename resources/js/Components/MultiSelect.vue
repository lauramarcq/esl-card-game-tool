<script setup>
import { ref, defineEmits, watch } from "vue";
const props = defineProps({
    buttonTitle: {
        type: String,
        required: true,
    },
    inputs: {
        type: Array,
        required: true,
    },
    modelValue: {
        type: Array,
        default: () => [],
    },
});

const showDropdown = ref(false);

const emit = defineEmits(["selectedItem"]);

const toggleDropdown = () => {
    showDropdown.value = !showDropdown.value;
};

watch(props.inputs, (newInputs, oldInputs) => {
    console.log(oldInputs);
    emit("selectedItem", newInputs);
});

// const markChecked = (value) => {
//     if (value !== "all") {
//         console.log("inside if", value);
//     } else {
//         console.log("inside else", value);
//         const checkboxes = document.querySelectorAll("input[type=checkbox]");
//         console.log(checkboxes);
//         checkboxes.checked = true;
//     }
// };
</script>
<template>
    <button
        id="dropdownBgHoverButton"
        data-dropdown-toggle="dropdownBgHover"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 max-w-64"
        type="button"
        @click="toggleDropdown"
    >
        {{ buttonTitle }}
        <svg
            class="w-2.5 h-2.5 ms-3"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 10 6"
        >
            <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m1 1 4 4 4-4"
            />
        </svg>
    </button>

    <div class="text-gray-700 text-xs mt-2">* Select one or more</div>

    <!-- Dropdown menu -->
    <div
        id="dropdownBgHover"
        class="z-10 w-48 bg-white rounded-lg shadow dark:bg-gray-700"
        v-show="showDropdown"
    >
        <ul
            class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
            aria-labelledby="dropdownBgHoverButton"
        >
            <li v-for="(input, key) in props.inputs" :key="key">
                <div
                    class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600"
                >
                    <input
                        :name="input.name"
                        v-model="input.value"
                        :track-by="input.name"
                        type="checkbox"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />
                    <label
                        :for="input.name"
                        class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                        >{{ input.name }}</label
                    >
                </div>
            </li>
        </ul>
    </div>
</template>
