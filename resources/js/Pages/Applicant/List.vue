<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3'
import Card from '@/Components/Flowbite/Card.vue';
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import Header from '@/Components/Flowbite/Table/Header.vue';
import Table from '@/Components/Flowbite/Table.vue';
import Pagination from '@/Components/Flowbite/Table/Pagination.vue';

const props = defineProps({
    applications: Object
});

const breadcrumb = [
    {name: "Home", href:route('dashboard')},
    {name: "Your Application", href:null},
];

const columns = ref([
    { field: ['vacancy', 'company', 'name'], text: 'Company Name', action: false },
    { field: ['vacancy', 'position', 'name'], text: 'Position', action: false },
    { field: 'created_at', text: 'Created At', action: false },
    { field: 'action', text: 'Action', action: true },
]);

const actions = ref([
    { name: 'View Status', emit: 'onPreview', href: 'applicants.show'}
]);

const onPreview = (data) => {
    router.get(route('applicants.show', { applicant : data.id}));
}

</script>
<template>
    <FlowbiteLayout title="Your applications" :breadcrumb="breadcrumb">
        <div class="border sm:rounded-lg border-gray-200 dark:border-gray-600 h-auto mb-4">
            <div class="bg-gray-50 rounded-lg dark:bg-gray-900 antialiased">
                <div class="mx-auto">
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <Header />
                        <Table :rows="applications.data" :columns="columns" :actions="actions"
                            @on-preview="onPreview"
                        />
                        <Pagination :links="applications.links" :meta="applications.meta"/>
                    </div>
                </div>
            </div>
        </div>
    </FlowbiteLayout>
</template>