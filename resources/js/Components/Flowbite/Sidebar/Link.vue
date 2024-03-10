<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: String,
    text: String,
    dropdown: Boolean
});
</script>

<template>
    <li v-if="!dropdown">
        <Link :href="href" class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <slot />
            <span class="ml-3">{{ text }}</span>
        </Link>
    </li>
    <li v-else>
        <Link :href="href" class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
            {{ text }}
        </Link>
    </li>
</template>