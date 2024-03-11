<script setup>

import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Form from '@/Components/Flowbite/Form.vue';
import TextInput from '@/Components/Flowbite/Form/TextInput.vue';
import { Modal } from 'flowbite';
import Action from '@/Components/Flowbite/Table/Action.vue';
import Filter from '@/Components/Flowbite/Table/Filter.vue';

const props = defineProps({
    searchText: {
        type: String,
        default: ''
    },
    actions: {
        type: Array,
        default: []
    },
    filters: {
        type: Array,
        default: []
    },
    addButtonText: {
        type: String,
        default: 'Add user'
    }
});

const emit = defineEmits(['openModal']);

const searchInput = ref(null);

const formSearch = useForm({
    search_text: props.searchText
});

const doSearch = () => {
    formSearch.get(route('users.index'));
}

</script>

<template>
    <div
        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
        <div class="w-full md:w-1/2">
            <form class="flex items-center" @submit.prevent="">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                            fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <TextInput
                        id="simple-search"
                        ref="searchInput"
                        v-model="formSearch.search_text"
                        type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Search"
                        @keyup.enter="doSearch"
                    />
                </div>
            </form>
        </div>
        <div
            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
            <button type="button" id="createUserModalButton" @click="emit('openModal')"
                class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                <svg class="mr-2 w-[17px] h-[17px]" fill="currentColor" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                </svg>
                {{ addButtonText }}
            </button>
            <div class="flex items-center space-x-3 w-full md:w-auto">
                <Action v-if="actions.length > 0"/>
                <Filter v-if="filters.length > 0"/>
            </div>
        </div>
    </div>
</template>