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
        return item.level.level;
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
                class="bg-gray-100 border-b border-gray-200 hover:bg-gray-200 min-w-10"
            >
                <td v-for="(value, key) in item" :key="key" class="p-2">
                    {{ value }}
                </td>

                <td class="p-4 flex flex-col space-x-2 justify-center">
                    <button
                        class="text-green-500 hover:text-green-700 font-bold py-2 px-2"
                        @click="$emit('selectedItem', item.id)"
                    >
                        Go
                    </button>

                    <button
                        class="text-red-500 hover:text-red-700 font-bold py-2 px-2"
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
