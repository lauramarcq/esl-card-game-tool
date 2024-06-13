<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import ListTable from "@/Components/ListTable.vue";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

const availableLists = ref([
    { name: "Subjects" },
    { name: "Predicates" },
    { name: "Time Phrases" },
]);

defineProps({
    subjects: Object,
});

const handleListEdit = (event, list) => {
    console.log(event);
    switch (list) {
        case "Subjects":
            console.log("Subjects");
            router.get("/subject", {
                replace: false,
            });
            console.log("After Inertia");
            break;
        case "Predicates":
            console.log("Predicates");
            break;
        case "Time Phrases":
            console.log("Time Phrases");
            break;
    }
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3>All Lists</h3>
                        <ListTable
                            v-for="(list, index) in availableLists"
                            :key="index"
                            :name="list.name"
                            @editList="handleListEdit(list.name)"
                        />
                    </div>
                    {{ subjects }}
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
