<script setup>
import { ref, computed } from "vue";

const selectedItems = ref([]);

const props = defineProps({
    tableHeaders: Array,
    items: Object,
    lists: Object,
});

const getListName = (id) => {
    const list = props.lists.find((l) => l.id === id);
    return list.name;
};

const getCurrentList = (id) => {
    return props.lists.find((l) => l.id === id);
};

const formatItem = () => {
    const items = props.items.data.map((item) => {
        return {
            id: item.id,
            name: item.item_value,
            ...(item.plural ? { plural: item.plural } : {}),
            listId: item.game_list_id,
            created_at: new Date(item.created_at).toLocaleString(),
        };
    });
    return items;
};

const formattedItems = computed(() => {
    return formatItem(props.items);
});

const colWidths = (header) => {
    if (header === "ID") {
        return "w-1/12";
    } else {
        return "w-1/6";
    }
};
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
                    :class="colWidths(header)"
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

                <td class="p-4 flex space-x-2">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                        id="delete-button"
                        @click="$emit('editItem', item)"
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
