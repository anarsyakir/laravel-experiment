<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    disabled: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <button v-if="disabled" :type="type" class="text-white bg-primary-400 dark:bg-primary-500 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        <slot />
    </button>
    <button v-else :type="type" class="text-white items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
        <slot />
    </button>
</template>
