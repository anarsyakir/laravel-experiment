<script setup>
import Breadcrumb from '@/Components/Flowbite/Breadcrumb.vue';

defineProps({
    breadcrumb: {
        type: Array,
        default: []
    }
});

</script>
<template>
    <main class="p-4 md:ml-64 pt-20">
        <div class="border bg-white sm:rounded-lg border-gray-200 dark:border-gray-600 h-auto mb-4 p-3">
            <Breadcrumb :breadcrumb="breadcrumb"/>
        </div>
        <slot />
    </main>
</template>