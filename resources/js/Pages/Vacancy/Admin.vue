<script setup>
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import Header from '@/Components/Flowbite/Table/Header.vue';
import Table from '@/Components/Flowbite/Table.vue';
import Pagination from '@/Components/Flowbite/Table/Pagination.vue';
import FlowbiteModal from '@/Components/Flowbite/Modal.vue';
import SecondaryButton from '@/Components/Flowbite/Button/Secondary.vue';
import Form from '@/Components/Flowbite/Form.vue';
import TextInput from '@/Components/Flowbite/Form/TextInput.vue';

const props = defineProps({
    vacancies: Object
});

const breadcrumb = [
    {name: "Home", href:route('dashboard')},
    {name: "Manage Vacancy", href:null},
];

const columns = ref([
    { field: ['company', 'name'], text: 'Company Name', action: false },
    { field: ['position', 'name'], text: 'Position', action: false },
    { field: 'created_at', text: 'Created At', action: false },
    { field: 'action', text: 'Action', action: true },
]);

const actions = ref([
    { name: 'Show Applicant', emit: 'onPreview'},
    { name: 'Edit', emit: 'onEdit'},
    { name: 'Delete', emit: 'onDelete'},
]);

const buttons = ref([
    { name: 'Add vacancy', emit: 'onAdd'}
]);

const title = ref('Create vacancy');
const formDelete = useForm({
    id: ''
});

const onAdd = () => {
    router.get(route('vacancies.create'));
}

const openDeleteModal = () => {
    const targetEl = document.getElementById('deleteUserModal');
    const modal = new Modal(targetEl, {closable: false});
    modal.show();
}

const closeDeleteModal = () => {
    const targetEl = document.getElementById('deleteUserModal');
    const modal = new Modal(targetEl, {closable: false});
    modal.hide();
    formDelete.reset();
}

const onEdit = (data) => {
    router.get(route('vacancies.edit', { vacancy : data.id}));
}

const onPreview = (data) => {
    router.get(route('applicant.admin', { vacancy : data.id}));
}

const onDelete = (data) => {
    formDelete.id = '' + data.id;
    openDeleteModal();
}

const doDelete = () => {
    formDelete.delete(route('users.destroy', {user: formDelete.id}), {
        onSuccess: () => closeDeleteModal(),
    });
}

</script>
<template>
    <FlowbiteLayout title="Vacancy List" :breadcrumb="breadcrumb">
        <div class="border sm:rounded-lg border-gray-200 dark:border-gray-600 h-auto mb-4">
            <div class="bg-gray-50 rounded-lg dark:bg-gray-900 antialiased">
                <div class="mx-auto">
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <Header :buttons="buttons" @on-add="onAdd"/>
                        <Table :rows="vacancies.data" :columns="columns" :actions="actions"
                            @on-edit="onEdit"
                            @on-preview="onPreview"
                            @on-delete="onDelete"
                        />
                        <Pagination :links="vacancies.links" :meta="vacancies.meta"/>
                    </div>
                </div>
            </div>
        </div>
    </FlowbiteLayout>

    <FlowbiteModal id="deleteUserModal" title="Confirm delete" @close="closeDeleteModal">
        <Form @submitted="doDelete">
            <template #form>
                <TextInput
                    id="deletedId"
                    v-model="formDelete.id"
                    type="hidden"
                />
                <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this user?</p>
            </template>
            <template #actions>
                <div class="flex justify-end items-center space-x-4">
                    <SecondaryButton type="button" @click="closeDeleteModal">Cancel</SecondaryButton>
                    <PrimaryButton :class="{ 'opacity-25': formDelete.processing }" :disabled="formDelete.processing">Yes</PrimaryButton>
                </div>
            </template>
        </Form>
    </FlowbiteModal>
</template>