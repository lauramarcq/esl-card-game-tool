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
    }
    if (header === "List ID") {
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
                    class="p-2 text-left"
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
                <td v-for="(value, key) in item" :key="key" class="p-2">
                    {{ value }}
                </td>

                <td class="p-2 flex space-x-2">
                    <button
                        class="hover:font-bold"
                        id="edit-button"
                        @click="$emit('editItem', item)"
                    >
                        Edit
                    </button>
                    <button
                        class="hover:font-bold text-red-500"
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
