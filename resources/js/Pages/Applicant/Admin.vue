<script setup>
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import Header from '@/Components/Flowbite/Header.vue';
import Table from '@/Components/Flowbite/Table.vue';
import Pagination from '@/Components/Flowbite/Table/Pagination.vue';
import FlowbiteModal from '@/Components/Flowbite/Modal.vue';

const props = defineProps({
    applications: Object
});

const breadcrumb = [
    {name: "Home", href:route('dashboard')},
    {name: "Manage Vacancy", href:route('vacancy.admin')},
    {name: "Applicants", href:null},
];

const columns = ref([
    { field: ['user', 'name'], text: 'Applicant Name', action: false },
    { field: 'created_at', text: 'Applied At', action: false },
    { field: 'action', text: 'Action', action: true },
]);

const actions = ref([
    { name: 'Review Applicant', emit: 'onPreview'},
]);

const onPreview = (data) => {
    router.get(route('applicant.show.admin', { applicant : data.id}));
}

</script>
<template>
    <FlowbiteLayout title="Applicant List" :breadcrumb="breadcrumb">
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