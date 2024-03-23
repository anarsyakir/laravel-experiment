<script setup>
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import Welcome from '@/Components/Welcome.vue';

const breadcrumb = [
    {name: "Home", href:route('dashboard')}
];

</script>

<template>
    <FlowbiteLayout title="Dashboard" :breadcrumb="breadcrumb">
        <Welcome />
    </FlowbiteLayout>
</template>
