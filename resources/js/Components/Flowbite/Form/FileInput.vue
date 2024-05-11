<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    id: String,
});

const emit = defineEmits(['onChange']);

const input = ref(null);

const onChange = () => {
    emit('onChange', props.id, input);
}

</script>

<template>
    <input
        :id="id"
        type="file"
        ref="input"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
        @change="onChange"
    >
</template>
