<script setup>
import { ref, computed } from "vue";

const selectedItems = ref([]);

const props = defineProps({
    tableHeaders: Array,
    items: Array,
});

const gameName = computed(() => {
    return props.items.map((item) => {
        return item.game.title;
    });
});

const levelName = computed(() => {
    return props.items.map((item) => {
        return item.level.level + "-" + item.level.description;
    });
});

const deck1CategoryName = computed(() => {
    return props.items.map((item) => {
        return item.deck1_category.name;
    });
});

const deck2CategoryName = computed(() => {
    return props.items.map((item) => {
        return item.deck2_category?.name;
    });
});

const deck3CategoryName = computed(() => {
    return props.items.map((item) => {
        return item.deck3_category?.name;
    });
});

const formatItem = () => {
    const items = props.items.map((item) => {
        return {
            id: item.id,
            game: gameName.value[item.game_id - 1],
            level: levelName.value[item.level_id - 1],
            decks: item.card_decks,
            cardQuantity: item.card_quantity,
            timer: item.show_timer ? "Yes" : "No",
            dice: item.show_dice ? "Yes" : "No",
            deck1: deck1CategoryName.value[item.deck_1_category_id] ?? "none",
            deck2: deck2CategoryName.value[item.deck_2_category_id] ?? "none",
            deck3: deck3CategoryName.value[item.deck_3_category_id] ?? "none",
            created_at: new Date(item.created_at).toLocaleString(),
        };
    });
    return items;
};

const formattedItems = computed(() => {
    return formatItem(props.items);
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
                    class="p-2 text-left"
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
                <td v-for="(value, key) in item" :key="key" class="p-2">
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

                    <!-- <button
                        class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                        id="delete-button"
                        @click="$emit('deleteItem', item.id)"
                    >
                        Delete
                    </button> -->
                </td>
            </tr>
        </tbody>
    </table>
</template>
