<script setup>
defineProps({
    action: {
        type: Boolean,
        default: false
    }
});

</script>

<template>
    <th v-if="action" scope="col" class="px-4 py-3">
        <span class="sr-only">
            <slot />
        </span>
    </th>
    <th v-else scope="col" class="px-4 py-4"><slot /></th>
</template>