<script setup>
import ItemTable from "@/Components/ItemTable.vue";
import { ref } from "vue";

const subjectHeaders = ref(["ID", "Name", "Description"]);

defineProps({
    subjects: Array,
});
</script>
<template>
    <ItemTable :tableHeaders="subjectHeaders" :items="subjects" />
</template>
