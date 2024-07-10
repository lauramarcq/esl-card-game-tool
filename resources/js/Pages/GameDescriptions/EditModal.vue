<template>
    <Modal :show="showDialog" closeable>
        <div
            class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4"
        >
            <h3
                class="text-base font-semibold leading-6 text-gray-900"
                id="modal-title"
            >
                Edit an item
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
                                        for="title"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >Title</label
                                    >
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                                        >
                                            <input
                                                type="text"
                                                name="title"
                                                id="title"
                                                ref="titleInput"
                                                v-model="formData.title"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                @input="
                                                    formData.errors.title = ''
                                                "
                                            />
                                        </div>
                                        <InputError
                                            :message="formData.errors.title"
                                            class="mt-2"
                                            id="title-error"
                                        />
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label
                                        for="subtitle"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >Subtitle</label
                                    >
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                                        >
                                            <input
                                                type="text"
                                                name="subtitle"
                                                id="subtitle"
                                                ref="subtitleInput"
                                                v-model="formData.subtitle"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                @input="
                                                    formData.errors.subtitle =
                                                        ''
                                                "
                                            />
                                        </div>
                                        <InputError
                                            :message="formData.errors.subtitle"
                                            class="mt-2"
                                            id="subtitle-error"
                                        />
                                    </div>
                                </div>

                                <div class="sm:col-span-12">
                                    <label
                                        for="description"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >Description</label
                                    >
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600"
                                        >
                                            <input
                                                name="description"
                                                id="description"
                                                ref="descriptionInput"
                                                v-model="formData.description"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                @input="
                                                    formData.errors.description =
                                                        ''
                                                "
                                            />
                                        </div>
                                        <InputError
                                            :message="
                                                formData.errors.description
                                            "
                                            class="mt-2"
                                            id="description-error"
                                        />
                                    </div>
                                </div>

                                <div class="sm:col-span-12">
                                    <label
                                        for="example"
                                        class="block text-sm font-medium leading-6 text-gray-900"
                                        >Example</label
                                    >
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600"
                                        >
                                            <input
                                                name="example"
                                                id="example"
                                                ref="exampleInput"
                                                v-model="formData.example"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                @input="
                                                    formData.errors.example = ''
                                                "
                                            />
                                        </div>
                                        <InputError
                                            :message="formData.errors.example"
                                            class="mt-2"
                                            id="example-error"
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
import { reactive, ref, defineProps, onMounted } from "vue";
import Modal from "@/Components/Modal.vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    showDialog: {
        type: Boolean,
    },
    item: {
        type: Object,
    },
});

const emit = defineEmits(["close"]);

const handleSubmit = () => {
    console.log("Submit");
};

const formData = useForm({
    title: props.item.title,
    subtitle: props.item.subtitle,
    description: props.item.description,
    example: props.item.example,
    errors: {
        title: null,
        subtitle: null,
        description: null,
        example: null,
    },
});

const handleCancel = () => {
    formData.reset();
    formData.clearErrors();
    emit("close");
};

onMounted(() => {
    console.log(props.item);
});
</script>
<style></style>
