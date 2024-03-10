<script setup>
import { computed, useSlots } from 'vue';

defineEmits(['submitted']);

const hasActions = computed(() => !! useSlots().actions);
</script>

<template>
    <form @submit.prevent="$emit('submitted')">
        <div class="grid gap-4 mb-4 sm:grid-cols-2">
            <slot name="form" />
        </div>

        <div v-if="hasActions">
            <slot name="actions" />
        </div>
    </form>
</template>