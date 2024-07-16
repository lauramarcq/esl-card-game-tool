<template>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
        <div v-if="data.data.length" class="p-6 text-gray-900">
            <div class="basis-3/4 flex flex-row justify-between">
                <h3
                    class="font-semibold text-lg text-gray-800 leading-tight py-2 px-4 m-4"
                >
                    List:
                    <span class="text-blue-800">{{
                        getListName(data.data[0].game_list_id)
                    }}</span>
                    - Level:
                    <span class="text-blue-800">{{ levelTitleContent }}</span>
                </h3>
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full inline-block m-4"
                    @click="handleAdd"
                >
                    Add a new item to list
                </button>
            </div>
            <ItemTable
                :tableHeaders="headers"
                :items="data"
                :lists="lists"
                @editItem="handleEdit"
                @deleteItem="handleDelete"
            />
            <div class="mt-4 flex justify-center">
                <Pagination :links="data.links" />
            </div>
            <CreateModal
                :showDialog="showCreate"
                :lists="lists"
                @close="showCreate = false"
                @showSuccess="showSuccessBanner = true"
            />
            <EditModal
                v-if="showEdit"
                :showDialog="showEdit"
                :item="selectedItem"
                :lists="lists"
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
        <div v-else class="mt-6 flex items-center justify-center">
            <img src="../../../assets/not-found.png" alt="" />
            <h3>
                No lists found or yet created. Go back to all lists
                <a
                    class="font-bold hover:text-green-800 underline decoration-solid"
                    href="/builder/list"
                    >here</a
                >
                or click on the button to add items to the
                <span class="font-bold">{{
                    getListName(getCurrentListIdFromPath)
                }}</span>
                list.
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full inline-block m-4"
                    @click="handleAdd"
                >
                    Add a new item
                </button>
            </h3>
            <CreateModal
                :showDialog="showCreate"
                :lists="lists"
                @close="showCreate = false"
                @showSuccess="showSuccessBanner = true"
            />
        </div>
    </div>
</template>
<script setup>
import ItemTable from "./ItemTable.vue";
import { ref, defineProps, onMounted, computed } from "vue";
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
    lists: {
        type: Object,
    },
    levels: {
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

const getCurrentListIdFromPath = computed(() => {
    const path = window.location.pathname;
    const listId = path.split("/").pop();
    return parseInt(listId);
});

const getLevelName = (id) => {
    const level = props.levels.find((l) => l.id === id);
    return level.level + " - " + level.description;
};

const getListName = (id) => {
    const list = props.lists.find((l) => l.id === id);
    return list.name;
};

const getCurrentList = (id) => {
    return props.lists.find((l) => l.id === id);
};

const levelTitleContent = computed(() => {
    const currentList = getCurrentList(props.data.data[0].game_list_id);
    const level = getLevelName(currentList.level_id);
    return level;
});

const baseHeaders = ref(["ID", "Item", "List ID", "Created At", "Actions"]);

const headers = computed(() => {
    const currentList = getCurrentList(props.data.data[0].game_list_id);
    if (currentList.category_id === 6) {
        let h = [...baseHeaders.value];
        h.splice(2, 0, "Plural");
        return h;
    }
    return baseHeaders.value;
});

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
        Inertia.delete(`/builder/list/item/${id}`);
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
