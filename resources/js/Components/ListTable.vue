<script setup>
import { defineEmits } from "vue";
defineProps({
    name: {
        type: String,
        required: true,
    },
});

const emit = defineEmits(["editList"]);
const editList = (event) => {
    emit("editList", event);
};
</script>

<template>
    <ul role="list" class="divide-y divide-gray-100">
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="min-w-0 flex-auto">
                    <p class="text-sm font-semibold leading-6 text-gray-900">
                        {{ name }}
                    </p>
                </div>
            </div>
            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                <div class="mt-1 leading-5 flex flex-row gap-4">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                        @click="editList($event)"
                    >
                        View and Edit
                    </button>
                </div>
            </div>
        </li>
    </ul>
</template>

<style></style>
