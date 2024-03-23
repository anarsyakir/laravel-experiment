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
    {name: "Reporting", href:null},
];

const columns = ref([
    { field: ['user', 'name'], text: 'Name', action: false },
]);

const onPreview = (data) => {
    router.get(route('applicants.show', { applicant : data.id}));
}

</script>
<template>
    <FlowbiteLayout title="Reporting" :breadcrumb="breadcrumb">
        <div class="border sm:rounded-lg border-gray-200 dark:border-gray-600 h-auto mb-4">
            <div class="bg-gray-50 rounded-lg dark:bg-gray-900 antialiased">
                <div class="mx-auto">
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <Header />
                        <Table :rows="applications.data" :columns="columns"
                            @on-preview="onPreview"
                        />
                        <Pagination :links="applications.links" :meta="applications.meta"/>
                    </div>
                </div>
            </div>
        </div>
    </FlowbiteLayout>
</template>