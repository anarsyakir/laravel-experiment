<script setup>
import { ref } from 'vue';
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import Header from '@/Components/Flowbite/Table/Header.vue';
import Table from '@/Components/Flowbite/Table.vue';
import Pagination from '@/Components/Flowbite/Table/Pagination.vue';

defineProps({
    users: Object
});

const columns = ref([
  { field: 'name', text: 'Name', action: false },
  { field: 'email', text: 'Email', action: false },
  { field: 'action', text: 'Action', action: true },
]);

</script>

<template>
    <FlowbiteLayout title="Manage User">
        <section class="bg-gray-50 rounded-lg dark:bg-gray-900 antialiased">
            <div class="mx-auto max-w-screen-xl">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <Header />
                    <Table :rows="users" :columns="columns"/>
                    <Pagination />
                </div>
            </div>
        </section>
    </FlowbiteLayout>
</template>
