<template>
    <Modal :show="showDialog" closeable>
        <div
            class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4"
        >
            <h3
                class="text-base font-semibold leading-6 text-gray-900"
                id="modal-title"
            >
                Are you sure you want to delete this category?
            </h3>
            <p class="font-bold text-yellow-600 mt-2">Warning!</p>
            <p class="text-sm text-gray-500 mt-2">
                By deleting a category, you will also delete all the lists and
                items associated with it.
            </p>
            <p class="text-sm text-gray-500 mt-2">
                This action cannot be undone!
            </p>
            <div class="border-b border-gray-900/10 pb-4"></div>

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
                    class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
                    @click="handleConfirm"
                >
                    Confirm
                </button>
            </div>
        </div>
    </Modal>
</template>
<script setup>
import { defineProps } from "vue";
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    showDialog: {
        type: Boolean,
    },
    id: {
        type: Number,
    },
});

const emit = defineEmits(["close", "confirm"]);

const handleConfirm = () => {
    emit("confirm", props.id);
};

const handleCancel = () => {
    emit("close");
};
</script>
<style></style>
