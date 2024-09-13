<script setup>
import { ref, computed } from "vue";

const selectedItems = ref([]);

const props = defineProps({
    tableHeaders: Array,
    items: Object,
    levels: Object,
    categories: Object,
});

const getLevelName = (id) => {
    const level = props.levels.find((level) => level.id === id);
    return level.level + " - " + level.description;
};

const getCategoryName = (id) => {
    const category = props.categories.find((cat) => cat.id === id);
    return category.name;
};

const formatItemDate = () => {
    const items = props.items.data.map((item) => {
        return {
            id: item.id,
            name: item.name,
            category: getCategoryName(item.category_id),
            level: getLevelName(item.level_id),
            created_at: new Date(item.created_at).toLocaleString(),
        };
    });
    return items;
};

const formattedItems = computed(() => {
    return formatItemDate(props.items);
});

const colWidths = (header) => {
    if (header === "ID") {
        return "w-1/12";
    }
    if (header === "Actions") {
        return "w-1/4";
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

                <td class="p-4 flex space-x-2">
                    <button
                        class="hover:font-bold text-green-500"
                        @click="$emit('selectedItem', item.id)"
                    >
                        View
                    </button>
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
