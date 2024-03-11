<script setup>
defineProps({
    action: {
        type: Boolean,
        default: false
    }
});
</script>

<template>
    <td v-if="!action" class="px-4 py-3"><slot/></td>
    <td class="px-4 py-3 flex items-center justify-end" v-else><slot/></td>
</template>