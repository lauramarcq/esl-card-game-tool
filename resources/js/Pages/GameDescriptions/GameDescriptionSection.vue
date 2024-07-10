<template>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
        <div class="p-6 text-gray-900">
            <div class="basis-3/4 flex flex-row justify-between">
                <h3
                    class="font-semibold text-lg text-gray-800 leading-tight py-2 px-4 m-4"
                >
                    Game Options
                </h3>
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full inline-block m-4"
                    @click="handleAddGameOption"
                >
                    Add a new game option
                </button>
            </div>
            <ItemTable
                :tableHeaders="gameDescriptionHeaders"
                :items="items"
                @editItem="showEdit = true"
                @deleteItem="handleDeleteGameOption"
            />
            <CreateModal :showDialog="showCreate" @close="showCreate = false" />
            <EditModal :showDialog="showEdit" @close="showEdit = false" />
            <DeleteModal
                :showDialog="showDeleteModal"
                :id="itemId"
                @close="showDeleteModal = false"
                @confirm="handleDeleteConfirm"
            />
        </div>
    </div>
</template>
<script setup>
import ItemTable from "./ItemTable.vue";
import { ref } from "vue";
import CreateModal from "./CreateModal.vue";
import EditModal from "./EditModal.vue";
import DeleteModal from "./DeleteModal.vue";

const showCreate = ref(false);
const showEdit = ref(false);
const showDeleteModal = ref(false);
let itemId = ref(null);

const gameDescriptionHeaders = ref([
    "ID",
    "Title",
    "Subtitle",
    "Description",
    "Example",
    "Created At",
    "Updated At",
    "Actions",
]);

const items = ref([
    {
        id: 1,
        title: "Game 1",
        subtitle: "Subtitle 1",
        description: "Description 1",
        example: "Example 1",
        created_at: "2021-09-01",
        updated_at: "2021-09-01",
    },
]);

const handleAddGameOption = () => {
    showCreate.value = true;
};

const handleDeleteGameOption = (id) => {
    showDeleteModal.value = true;
    itemId.value = id;
};

const handleDeleteConfirm = (id) => {
    console.log("DeleteConfirm", id);
    showDeleteModal.value = false;
    // items.value = items.value.filter((item) => item.id !== id);
};
</script>
<style scoped></style>
