<script setup>
import ItemTable from "@/Components/ItemTable.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Modal from "@/Components/Modal.vue";
const showDialog = ref(false);

const subjectHeaders = ref([
    "ID",
    "Name",
    "Created At",
    "Updated At",
    "Actions",
]);

defineProps({
    subjects: Array,
});

const formData = useForm({
    name: "",
    price: "",
    errors: {
        name: null,
        price: null,
    },
});

const handleSubmit = () => {
    console.log("Submit");
    // formData.post(route("lists.create", { listId: props.listId }), {
    //     onSuccess: () => {
    //         emit("update:modelValue", false);
    //     },
    //     onError: (error) => {
    //         console.log("Error", error);
    //         if (formData.errors.name) {
    //             nameInput.value.focus();
    //         }
    //         if (formData.errors.price) {
    //             priceInput.value.focus();
    //         }
    //     },
    // });
};

const handleCancel = () => {
    formData.reset();
    formData.clearErrors();
    showDialog.value = false;
};
</script>
<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-row">
                <h2
                    class="font-semibold text-xl text-gray-800 leading-tight self-center justify-self-start basis-1/4"
                >
                    View and Edit Subject List
                </h2>
                <div class="basis-3/4 flex flex-row justify-end">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full inline-block m-4"
                        @click="showDialog = true"
                    >
                        Add a subject
                    </button>
                    <Link
                        href="/dashboard"
                        class="hover:bg-gray-700 hover:text-white font-bold py-2 px-4 rounded-full inline-block m-4"
                        >Back to all lists
                    </Link>
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <ItemTable
                            :tableHeaders="subjectHeaders"
                            :items="subjects"
                        />
                    </div>
                </div>
            </div>
        </div>

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
                                                        formData.errors.name =
                                                            ''
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
                                                        formData.errors.price =
                                                            ''
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
    </AuthenticatedLayout>
</template>
