<script setup>
import Th from './Table/Th.vue';
import Tr from './Table/Tr.vue';

defineProps({
    rows: Array,
    columns: Array
});

</script>

<template>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <Th v-for="column in columns" :key="column.field" :action="column.action">{{ column.text }}</Th>
                </tr>
            </thead>
            <tbody>
                <Tr v-for="row in rows" :key="row.id" :row="row" :columns="columns"/>
            </tbody>
        </table>
    </div>
</template>