<template>
    <Modal :show="showDialog" closeable>
        <div
            class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4"
        >
            <h3
                class="text-base font-semibold leading-6 text-gray-900"
                id="modal-title"
            >
                Add a subject
            </h3>
            <div class="mt-2">
                <form class="w-full" @submit.prevent="handleSubmit">
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <div
                                class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12"
                            >
                                <div class="sm:col-span-6">
                                    <label
                                        for="name"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >Item name</label
                                    >
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                                        >
                                            <input
                                                type="text"
                                                name="name"
                                                id="name"
                                                ref="nameInput"
                                                v-model="formData.name"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                placeholder="Apples"
                                                @input="
                                                    formData.errors.name = ''
                                                "
                                            />
                                        </div>
                                        <InputError
                                            :message="formData.errors.name"
                                            class="mt-2"
                                            id="name-error"
                                        />
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label
                                        for="price"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >price</label
                                    >
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                                        >
                                            <input
                                                type="text"
                                                name="price"
                                                id="price"
                                                ref="priceInput"
                                                v-model="formData.price"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                placeholder="£ 2.96"
                                                @input="
                                                    formData.errors.price = ''
                                                "
                                            />
                                        </div>
                                        <InputError
                                            :message="formData.errors.price"
                                            class="mt-2"
                                            id="price-error"
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
                            Cancel
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
import { reactive, ref, defineProps } from "vue";
import Modal from "@/Components/Modal.vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    showDialog: {
        type: Boolean,
    },
});

const emit = defineEmits(["close"]);

const handleSubmit = () => {
    console.log("Submit");
};

const formData = useForm({
    name: "",
    price: "",
    errors: {
        name: null,
        price: null,
    },
});

const handleCancel = () => {
    formData.reset();
    formData.clearErrors();
    emit("close");
};
</script>
<style></style>
