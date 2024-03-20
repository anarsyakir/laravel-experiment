<script setup>
import { computed, useSlots } from 'vue';
import { Link } from '@inertiajs/vue3';

defineProps({
   title: String,
   link: String,
});

const hasButtons = computed(() => !! useSlots().button);
</script>

<template>
    <div class="mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <Link v-if="title" :href="link">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ title }}</h5>
        </Link>
        <hr v-if="title" class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
        <slot name="content"/>
        <div v-if="hasButtons" class="flex justify-end items-center space-x-4">
            <slot name="button"/>
        </div>
    </div>
</template>