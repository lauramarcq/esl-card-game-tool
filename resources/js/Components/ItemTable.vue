<script setup>
import { ref } from "vue";

const selectedItems = ref([]);

defineProps({
    tableHeaders: Array,
    items: Array,
});
</script>

<template>
    <table class="table-fixed" style="width: 100%">
        <thead>
            <tr
                class="bg-gray-100 border-b border-gray-200 hover:bg-gray-200 min-w-10"
            >
                <th
                    v-for="(header, i) in tableHeaders"
                    :key="i"
                    class="p-4 text-left"
                >
                    {{ header }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="item in items"
                :key="item.id"
                :class="{
                    'bg-green-100 border-b border-green-200 hover:bg-green-200 min-w-10 text-green-800':
                        selectedItems.includes(item.id),
                    'bg-gray-100 border-b border-gray-200 hover:bg-gray-200 min-w-10':
                        !selectedItems.includes(item.id),
                }"
            >
                <td v-for="(value, key) in item" :key="key" class="p-4">
                    {{ value }}
                </td>

                <td class="p-4 flex space-x-2 justify-center">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                        @click="$emit('selectedItem', item.id)"
                    >
                        {{
                            selectedItems.includes(item.id)
                                ? "Deselect"
                                : "Select for game"
                        }}
                    </button>
                    <button
                        class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                        id="delete-button"
                        @click="$emit('deleteItem', item.id)"
                    >
                        Delete
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</template>
