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
                :items="data"
                @editItem="handleEditGameOption"
                @deleteItem="handleDeleteGameOption"
            />
            <div class="mt-4 flex justify-center">
                <Pagination :links="data.links" />
            </div>
            <CreateModal
                :showDialog="showCreate"
                @close="showCreate = false"
                @showSuccess="showSuccessBanner = true"
            />
            <EditModal
                v-if="showEdit"
                :showDialog="showEdit"
                :item="selectedItem"
                @close="showEdit = false"
            />
            <DeleteModal
                :showDialog="showDeleteModal"
                :id="itemId"
                @close="showDeleteModal = false"
                @confirm="handleDeleteConfirm"
            />
            <div class="mt-2 flex justify-center">
                <SuccessBanner
                    :show="showSuccessBanner"
                    @close="showSuccessBanner = false"
                />
            </div>
        </div>
    </div>
</template>
<script setup>
import ItemTable from "./ItemTable.vue";
import { ref, defineProps } from "vue";
import CreateModal from "./CreateModal.vue";
import EditModal from "./EditModal.vue";
import DeleteModal from "./DeleteModal.vue";
import Pagination from "@/Components/Pagination.vue";
import SuccessBanner from "@/Components/SuccessBanner.vue";

const props = defineProps({
    data: {
        type: Object,
    },
});

const showSuccessBanner = ref(false);
const showCreate = ref(false);
const showEdit = ref(false);
const showDeleteModal = ref(false);
let itemId = ref(null);
let selectedItem = ref({});

const gameDescriptionHeaders = ref([
    "ID",
    "Title",
    "Subtitle",
    "Description",
    "Example",
    "Created At",
    "Actions",
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

const handleEditGameOption = (item) => {
    showEdit.value = true;
    selectedItem.value = item;
};
</script>
<style scoped></style>
