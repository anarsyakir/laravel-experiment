<script setup>

const props = defineProps({
   id: String,
   actions: Array,
   data: Object
});

const emit = defineEmits(['onEdit', 'onPreview', 'onDelete']);

const buttonId = props.id + '-dropdown-button';
const dropdownId = props.id + '-dropdown';

</script>

<template>
    <div>
        <button :id="buttonId" :data-dropdown-toggle="dropdownId"
            class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
            </svg>
        </button>
        <div :id="dropdownId" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
            <ul class="py-1 text-sm" :aria-labelledby="buttonId">
                <li v-for="action in actions">
                    <button type="button" @click="emit(action.emit, data)" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                        {{ action.icon ? action.icon : '' }}
                        {{ action.name }}
                    </button>
                </li>
            </ul>
        </div>
    </div>
</template>