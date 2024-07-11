<template>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
        <div class="p-6 text-gray-900">
            <div class="basis-3/4 flex flex-row justify-between">
                <h3
                    class="font-semibold text-lg text-gray-800 leading-tight py-2 px-4 m-4"
                >
                    Lists
                </h3>
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full inline-block m-4"
                    @click="handleAdd"
                >
                    Add a new list
                </button>
            </div>
            <ItemTable
                :tableHeaders="headers"
                :items="data"
                :levels="levels"
                :categories="categories"
                @editItem="handleEdit"
                @deleteItem="handleDelete"
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
                @showSuccess="showSuccessBanner = true"
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
                    :message="bannerMessage"
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
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    data: {
        type: Object,
    },
    levels: {
        type: Object,
    },
    categories: {
        type: Object,
    },
});

const showSuccessBanner = ref(false);
const showCreate = ref(false);
const showEdit = ref(false);
const showDeleteModal = ref(false);
let itemId = ref(null);
let selectedItem = ref({});
let bannerMessage = ref("");

const headers = ref([
    "ID",
    "Name",
    "Category",
    "Level",
    "Created At",
    "Actions",
]);

const handleAdd = () => {
    showCreate.value = true;
    bannerMessage.value = "Your item has been successfully added.";
};

const handleDelete = (id) => {
    showDeleteModal.value = true;
    itemId.value = id;
};

const handleDeleteConfirm = (id) => {
    try {
        showDeleteModal.value = false;
        Inertia.delete(`/builder/game-options/${id}`);
    } catch (error) {
        console.log(error);
    }
    showSuccessBanner.value = true;
    bannerMessage.value = "Your item has been successfully deleted.";
};

const handleEdit = (item) => {
    showEdit.value = true;
    selectedItem.value = item;
    bannerMessage.value = "Your item has been successfully updated.";
};
</script>
<style scoped></style>
