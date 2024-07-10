<template>
    <Link
        v-for="(link, i) in links"
        :key="i"
        :href="link.url || 'null'"
        v-html="link.label"
        class="px-1 py-1 pt-1"
        :class="{
            'text-gray-500 pointer-events-none': !link.url,
            'font-bold text-blue-500': link.active,
        }"
        preserve-state
        preserve-scroll
    ></Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    links: {
        type: Array,
        required: true,
    },
});
</script>

<style></style>
