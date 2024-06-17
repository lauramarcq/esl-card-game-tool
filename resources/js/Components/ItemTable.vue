<script setup>
import { ref, computed } from "vue";

const selectedItems = ref([]);

const props = defineProps({
    tableHeaders: Array,
    items: Array,
});

const formatItemDate = () => {
    const items = props.items.map((item) => {
        return {
            id: item.id,
            name: item.subject,
            created_at: new Date(item.created_at).toLocaleString(),
            updated_at: new Date(item.updated_at).toLocaleString(),
        };
    });
    console.log(items);
    return items;
};

const formattedItems = computed(() => {
    return formatItemDate(props.items);
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
                    :class="header === 'ID' ? 'w-1/12' : 'w-1/4'"
                >
                    {{ header }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="item in formattedItems"
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
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full"
                        @click="$emit('selectedItem', item.id)"
                    >
                        {{
                            selectedItems.includes(item.id)
                                ? "Deselect"
                                : "Select"
                        }}
                    </button>
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                        id="delete-button"
                        @click="$emit('editItem', item.id)"
                    >
                        Edit
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
