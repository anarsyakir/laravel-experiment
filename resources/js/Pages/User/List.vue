<script setup>
import { ref } from 'vue';
import { Modal, initFlowbite } from 'flowbite';
import { useForm } from '@inertiajs/vue3';
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import Header from '@/Components/Flowbite/Table/Header.vue';
import Table from '@/Components/Flowbite/Table.vue';
import Pagination from '@/Components/Flowbite/Table/Pagination.vue';
import FlowbiteModal from '@/Components/Flowbite/Modal.vue';
import Form from '@/Components/Flowbite/Form.vue';
import TextInput from '@/Components/Flowbite/Form/TextInput.vue';
import InputLabel from '@/Components/Flowbite/Form/InputLabel.vue';
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';
import SecondaryButton from '@/Components/Flowbite/Button/Secondary.vue';
import InputError from '@/Components/InputError.vue';

defineProps({
    users: Object,
    searchText: String
});

const columns = ref([
  { field: 'name', text: 'Name', action: false },
  { field: 'email', text: 'Email', action: false },
  { field: 'created_at', text: 'Created At', action: false },
  { field: 'action', text: 'Action', action: true },
]);

const actions = ref([
    { name: 'Edit', emit: 'onEdit'},
    // { name: 'Preview', emit: 'onPreview'},
    { name: 'Delete', emit: 'onDelete'},
]);

const form = useForm({
    id: '',
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const title = ref('Create user');
const formDelete = useForm({
    id: ''
});

const submit = () => {
    if(form.id != ''){
        form.put(route('users.update', { user : form.id}), {
            onSuccess: () => closeModal(),
        });
    } else {
        form.post(route('users.store'), {
            onSuccess: () => closeModal(),
        });
    }
};

const closeModal = () => {
    const targetEl = document.getElementById('createUserModal');
    const modal = new Modal(targetEl);
    modal.hide();
    form.reset();
    title.value = 'Create user';
    initFlowbite();
};

const openModal = () => {
    const targetEl = document.getElementById('createUserModal');
    const modal = new Modal(targetEl, {closable: false});
    modal.show();
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
    form.id = '' + data.id;
    form.name = data.name;
    form.email = data.email;
    title.value = 'Edit user';
    openModal();
}

const onPreview = (data) => {
    console.log('Preview');
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
    <FlowbiteLayout title="Manage User">
        <section class="bg-gray-50 rounded-lg dark:bg-gray-900 antialiased">
            <div class="mx-auto max-w-screen-xl">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <Header :search-text="searchText" @open-modal="openModal"/>
                    <Table :rows="users.data" :columns="columns" :actions="actions"
                        @on-edit="onEdit"
                        @on-preview="onPreview"
                        @on-delete="onDelete"
                    />
                    <Pagination :links="users.links" :meta="users.meta"/>
                </div>
            </div>
        </section>
    </FlowbiteLayout>

    <FlowbiteModal id="createUserModal" :title="title" @close="closeModal">
        <Form @submitted="submit">
            <template #form>
                <TextInput
                    id="id"
                    v-model="form.id"
                    type="hidden"
                />
                <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        placeholder="User name"
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        placeholder="User email"
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <div>
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        placeholder="User password"
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>
                <div>
                    <InputLabel for="password_confirmation" value="Confirm password" />
                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        placeholder="Confirm password"
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>
            </template>
            <template #actions>
                <div class="flex justify-end items-center space-x-4">
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</PrimaryButton>
                </div>
            </template>
        </Form>
    </FlowbiteModal>

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
