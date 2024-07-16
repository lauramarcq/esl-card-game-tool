<template>
    <Modal :show="showDialog" closeable>
        <div
            class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4"
        >
            <h3
                class="text-base font-semibold leading-6 text-gray-900"
                id="modal-title"
            >
                Add a new item to list
            </h3>
            <div class="mt-2">
                <form class="w-full" @submit.prevent="handleSubmit">
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <div
                                class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12"
                            >
                                <div class="sm:col-span-12">
                                    <label
                                        for="item_value"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >Word or phrase</label
                                    >
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                                        >
                                            <input
                                                type="text"
                                                name="item_value"
                                                id="item_value"
                                                ref="item_valueInput"
                                                v-model="formData.item_value"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                @input="
                                                    formData.errors.item_value =
                                                        ''
                                                "
                                            />
                                        </div>
                                        <InputError
                                            :message="
                                                formData.errors.item_value
                                            "
                                            class="mt-2"
                                            id="name-error"
                                        />
                                    </div>
                                </div>

                                <div
                                    v-if="currentList === 6"
                                    class="sm:col-span-12"
                                >
                                    <label
                                        for="item_value"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >Plural</label
                                    >
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                                        >
                                            <input
                                                type="text"
                                                name="plural"
                                                id="plural"
                                                ref="pluralInput"
                                                v-model="formData.plural"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                @input="
                                                    formData.errors.plural = ''
                                                "
                                            />
                                        </div>
                                        <InputError
                                            :message="formData.errors.plural"
                                            class="mt-2"
                                            id="name-error"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button
                            type="button"
                            id="cancel-button"
                            class="text-sm font-semibold leading-6 text-gray-900"
                            @click="handleCancel"
                        >
                            Close
                        </button>
                        <button
                            type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </Modal>
</template>
<script setup>
import { reactive, ref, defineProps, computed } from "vue";
import Modal from "@/Components/Modal.vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    showDialog: {
        type: Boolean,
    },
    lists: {
        type: Object,
    },
});

const path = window.location.pathname;
const pathArray = path.split("/");
const pathListId = Number(pathArray[pathArray.length - 1]);

const emit = defineEmits(["close", "showSuccess"]);

const currentList = computed(() => {
    const list = props.lists.find((list) => list.id === pathListId);
    return list.category_id;
});

const formData = useForm({
    item_value: "",
    plural: "",
    game_list_id: pathListId,
    errors: {
        name: null,
    },
});

const handleCancel = () => {
    formData.reset();
    formData.clearErrors();
    emit("close");
};

const handleSubmit = () => {
    formData.post("/builder/list/item", {
        preserveScroll: true,
        onSuccess: () => {
            formData.reset();
            emit("close");
            emit("showSuccess");
        },
        onError: (e) => {
            console.log("Error", e);
        },
    });
};
</script>
<style>
.multiselect__content-wrapper {
    max-height: 100px !important;
    overflow-y: auto;
}
</style>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
