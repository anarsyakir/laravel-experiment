<script setup>
defineProps({
    time: String,
    image: String,
    imageAlt: String,
});
</script>
<template>
    <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
        <div class="flex-shrink-0">
            <img class="w-11 h-11 rounded-full"
                :src="image"
                :alt="imageAlt" />
            <div
                class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-primary-700 dark:border-gray-700">
                <slot name="icon"/>
            </div>
        </div>
        <div class="pl-3 w-full">
            <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                <slot name="message"/>
            </div>
            <div class="text-xs font-medium text-primary-600 dark:text-primary-500">
                {{ time }}
            </div>
        </div>
    </a>
</template>