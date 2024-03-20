<script setup>
import Td from './Td.vue';
import Dropdown from '@/Components/Flowbite/Table/Dropdown.vue'

defineProps({
    row: Object,
    columns: Object,
    actions: {
        type: Array,
        default: []
    }
});

const emit = defineEmits(['onEdit', 'onPreview', 'onDelete']);

const onEdit = (data) => {
    emit('onEdit', data);
}

const onPreview = (data) => {
    emit('onPreview', data);
}

const onDelete = (data) => {
    emit('onDelete', data);
}

</script>

<template>
    <tr class="border-b dark:border-gray-700">
        <Td v-for="column in columns" :key="column.field" :action="column.action">
            <Dropdown v-if="column.action" :id="'id' + row.id" :actions="actions" :data="row" 
                @onEdit="onEdit" 
                @onPreview="onPreview" 
                @onDelete="onDelete"/>
            <span v-else-if="Array.isArray(column.field) && column.field.length == 2">{{ row[column.field[0]][column.field[1]] }}</span>
            <span v-else-if="Array.isArray(column.field) && column.field.length == 3">{{ row[column.field[0]][column.field[1]][column.field[2]] }}</span>
            <span v-else>{{ row[column.field] }}</span>
        </Td>
    </tr>
</template>