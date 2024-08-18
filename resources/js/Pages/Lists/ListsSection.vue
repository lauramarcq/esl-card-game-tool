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
            <div class="flex flex-row justify-start py-2 px-4 m-4 gap-10">
                <p class="text-gray-800 leading-tight">Filters</p>
                <form
                    class="w-full flex flex-row justify-start gap-10"
                    @submit.prevent="handleFilterApply"
                >
                    <div class="w-1/3">
                        <label
                            class="typo__label text-sm font-semibold leading-6 text-gray-900"
                            >Category</label
                        >
                        <div class="mt-2">
                            <VueMultiselect
                                v-model="formData.category"
                                :options="props.categories"
                                :multiple="true"
                                placeholder="Select one or more"
                                label="name"
                                track-by="id"
                                :close-on-select="true"
                            >
                            </VueMultiselect>
                        </div>
                    </div>

                    <div class="w-1/3">
                        <label
                            class="typo__label text-sm font-semibold leading-6 text-gray-900"
                            >Level</label
                        >
                        <div class="mt-2">
                            <VueMultiselect
                                v-model="formData.level"
                                :options="props.levels"
                                :multiple="true"
                                placeholder="Select one or more"
                                label="level"
                                track-by="id"
                                :close-on-select="true"
                            >
                            </VueMultiselect>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button
                            type="button"
                            id="cancel-button"
                            class="text-sm font-semibold leading-6 text-gray-900 hover:text-green-500"
                            @click="handleClear"
                        >
                            Clear
                        </button>
                        <button
                            type="submit"
                            class="px-3 py-2 text-sm font-semibold shadow-sm hover:text-green-500"
                        >
                            Apply
                        </button>
                    </div>
                </form>
            </div>
            <ItemTable
                v-if="data.data.length > 0"
                :tableHeaders="headers"
                :items="data"
                :levels="levels"
                :categories="categories"
                @editItem="handleEdit"
                @deleteItem="handleDelete"
                @selectedItem="handleSelect"
            />
            <div v-if="data.data.length > 0" class="mt-4 flex justify-center">
                <Pagination :links="data.links" />
            </div>
            <div
                v-if="data.data.length === 0"
                class="mt-6 flex items-center justify-center"
            >
                <img src="../../../assets/not-found.png" alt="" />
                <h3>No items found. Clear filters and try another search</h3>
            </div>
            <CreateModal
                :showDialog="showCreate"
                :levels="levels"
                :categories="categories"
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
import { ref, defineProps, onMounted } from "vue";
import CreateModal from "./CreateModal.vue";
import EditModal from "./EditModal.vue";
import DeleteModal from "./DeleteModal.vue";
import Pagination from "@/Components/Pagination.vue";
import SuccessBanner from "@/Components/SuccessBanner.vue";
import { Inertia } from "@inertiajs/inertia";
import VueMultiselect from "vue-multiselect";
import { useRemember, router } from "@inertiajs/vue3";

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

const formData = useRemember(
    {
        category: [],
        level: [],
    },
    "filters"
);

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
        Inertia.delete(`/builder/list/${id}`);
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

const handleSelect = (id) => {
    Inertia.visit(`/builder/list/item/${id}`);
};

const handleFilterApply = () => {
    const category = formData.value.category.map((item) => item.id).join(",");
    const level = formData.value.level.map((item) => item.id).join(",");
    const url = `/builder/list?category=${category}&level=${level}`;
    Inertia.get(url);
};

const handleClear = () => {
    formData.value.category = [];
    formData.value.level = [];
    const url = `/builder/list?category=&level=`;
    Inertia.get(url);
};

const getParameters = (parameterName, propsData) => {
    const parameterValue = new URLSearchParams(window.location.search).get(
        parameterName
    );
    const parameterArray = parameterValue
        ? parameterValue.split(",").map((item) => ({ id: parseInt(item) }))
        : [];
    return propsData.filter((item) =>
        parameterArray.some((param) => param.id === item.id)
    );
};

onMounted(() => {
    const getCategory = getParameters("category", props.categories);
    const getLevel = getParameters("level", props.levels);

    formData.value.category = getCategory;
    formData.value.level = getLevel;
});
</script>
<style scoped></style>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
