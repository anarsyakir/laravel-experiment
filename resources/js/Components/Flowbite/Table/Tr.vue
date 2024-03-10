<script setup>
import Td from './Td.vue';

defineProps({
    row: Object,
    columns: Object
})
</script>

<template>
    <tr class="border-b dark:border-gray-700">
        <Td v-for="column in columns" :key="column.field">{{ !column.action ? row[column.field] : '' }}</Td>
    </tr>
</template>