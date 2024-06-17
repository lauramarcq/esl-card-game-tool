<script setup>
import { ref, defineEmits } from "vue";
const props = defineProps({
    buttonTitle: {
        type: String,
        required: true,
    },
    inputs: {
        type: Array,
        required: true,
    },
});

const showDropdown = ref(false);
const checkboxes = ref(null);

const emit = defineEmits(["selectedItem"]);

const toggleDropdown = () => {
    showDropdown.value = !showDropdown.value;
};

const selectItem = (value) => {
    emit("selectedItem", value);
    if (value === "all") {
        checkboxes.checked = true;
    }
};
</script>
<template>
    <button
        id="dropdownBgHoverButton"
        data-dropdown-toggle="dropdownBgHover"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
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
                        v-model="checkboxes"
                        :id="input.name"
                        type="checkbox"
                        :value="input.value"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                        @change="
                            selectItem(
                                $event.target.checked
                                    ? $event.target.value
                                    : null
                            )
                        "
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
