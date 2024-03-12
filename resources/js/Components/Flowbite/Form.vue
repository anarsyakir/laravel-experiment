<script setup>
import { computed, useSlots } from 'vue';

defineProps({
    col: {
        type: String,
        default: 'sm:grid-cols-2'
    }
})

defineEmits(['submitted']);

const hasActions = computed(() => !! useSlots().actions);
</script>

<template>
    <form @submit.prevent="$emit('submitted')">
        <div :class="'grid gap-4 mb-4 ' + col">
            <slot name="form" />
        </div>

        <div v-if="hasActions">
            <slot name="actions" />
        </div>
    </form>
</template>