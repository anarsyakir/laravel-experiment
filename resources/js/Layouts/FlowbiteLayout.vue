<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { initFlowbite } from 'flowbite';
import Navbar from '@/Components/Flowbite/Navbar.vue';
import Sidebar from '@/Components/Flowbite/Sidebar.vue';
import Main from '@/Components/Flowbite/Main.vue';

onMounted(() => {
    initFlowbite();
});

defineProps({
    title: String,
    breadcrumb: {
        type: Array,
        default: []
    }
});

const showingNavigationDropdown = ref(false);

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <Head :title="title" />
        <Navbar :user="$page.props.auth.user"/>
        <Sidebar />
        <Main :breadcrumb="breadcrumb">
            <slot />
        </Main>
    </div>
</template>