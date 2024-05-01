<script setup>
import { onMounted, ref } from 'vue';
import { Modal, initFlowbite, initDropdowns } from 'flowbite';
import { useForm } from '@inertiajs/vue3';
import Form from '@/Components/Flowbite/Form.vue';
import Table from '@/Components/Flowbite/Table.vue';
import TextInput from '@/Components/Flowbite/Form/TextInput.vue';
import SelectInput from '@/Components/Flowbite/Form/SelectInput.vue';
import InputLabel from '@/Components/Flowbite/Form/InputLabel.vue';
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';
import SecondaryButton from '@/Components/Flowbite/Button/Secondary.vue';
import InputError from '@/Components/InputError.vue';
import FlowbiteModal from '@/Components/Flowbite/Modal.vue';
import Pagination from '@/Components/Flowbite/Table/Pagination.vue';
import Textarea from '@/Components/Flowbite/Form/Textarea.vue';
import Datepicker from 'flowbite-datepicker/Datepicker';

const props = defineProps({
    userExperiences: Object,
    positions: Object,
});

const formExperience = useForm({
    id: '',
    company: '',
    position_id: '',
    description: '',
    start_at: '',
    end_at: ''
});

const addExperience = () => {
    formExperience.start_at = start_at.value.getDate('yyyy-mm-dd');
    formExperience.end_at = end_at.value.getDate('yyyy-mm-dd');
    
    if(formExperience.id != ''){
        formExperience.put(route('user-experience.update', { user_experience : formExperience.id}), {
            onSuccess: () => showMessage(),
        });
    } else {
        formExperience.post(route('user-experience.store'), {
            preserveScroll: true,
            onSuccess: () => showMessage(),
        });
    }
};

const showMessage = () => {
    resetForm();
    initDropdowns();
    console.log('Success');
};

const resetForm = () => {
    formExperience.reset();
    resetSelectNCheckbox();
};

const onEdit = (data) => {
    formExperience.id = '' + data.id;
    formExperience.company = data.company;
    formExperience.position_id = '' + data.position.id;
    formExperience.description  = '' + data.description;
    // formExperience.start_at = data.start_at;
    // formExperience.end_at = data.end_at;
    start_at.value.setDate(data.start_at);
    end_at.value.setDate(data.end_at);

    const children = document.getElementById('position').children;
    for (var i = 0; i < children.length; i++) {
        if(children[i].value == data.position.id) {
            children[i].setAttribute('selected', true);
        } else {
            children[i].removeAttribute('selected');
        }
    }
}

const formDelete = useForm({
    id: ''
});

const onDelete = (data) => {
    formDelete.id = '' + data.id;
    openDeleteModal();
}

const doDelete = () => {
    formDelete.delete(route('user-experience.destroy', {user_experience: formDelete.id}), {
        onSuccess: () => closeDeleteModal(),
    });
}

const openDeleteModal = () => {
    const targetEl = document.getElementById('deleteExperienceModal');
    const modal = new Modal(targetEl, {closable: false});
    modal.show();
}

const closeDeleteModal = () => {
    const targetEl = document.getElementById('deleteExperienceModal');
    const modal = new Modal(targetEl, {closable: false});
    modal.hide();
    formDelete.reset();
}

const resetSelectNCheckbox = () => {
    const children = document.getElementById('position').children;
    for (var i = 0; i < children.length; i++) {
        children[i].removeAttribute('selected');
    }
}

const columns = ref([
    { field: 'company', text: 'Company', action: false },
    { field: ['position', 'name'], text: 'Position', action: false },
    { field: 'description', text: 'Description', action: false },
    { field: 'start_at', text: 'Start At', action: false },
    { field: 'end_at', text: 'End At', action: false },
    { field: 'action', text: 'Action', action: true },
]);

const actions = ref([
    { name: 'Edit', emit: 'onEdit'},
    { name: 'Delete', emit: 'onDelete'},
]);

const start_at = ref(null);
const end_at = ref(null);

onMounted(() => {
    initFlowbite();
    const startAt = document.getElementById('start_at');
    start_at.value = new Datepicker(startAt, {format: 'yyyy-mm-dd', autohide: true});
    const endAt = document.getElementById('end_at');
    end_at.value = new Datepicker(endAt, {format: 'yyyy-mm-dd', autohide: true}); 
    console.log(end_at.value);
});

</script>

<template>
    <div class="grid gap-4 mb-4">
        <Form @submitted="addExperience" col="sm:grid-cols-2">
            <template #form>
                <TextInput
                    id="expId"
                    v-model="formExperience.id"
                    type="hidden"
                />
                <div>
                    <InputLabel for="company" value="Company" />
                    <TextInput
                        id="company"
                        v-model="formExperience.company"
                        type="text"
                        placeholder="Company"
                        autofocus
                    />
                    <InputError class="mt-2" :message="formExperience.errors.company" />
                </div>
                <div>
                    <InputLabel for="position" value="Position" />
                    <SelectInput
                        id="position"
                        v-model="formExperience.position_id"
                    >
                        <option>Choose position</option>
                        <template v-for="position in positions">
                            <option :value="position.id">{{ position.name }}</option>
                        </template>
                    </SelectInput>
                    <InputError class="mt-2" :message="formExperience.errors.position_id" />
                </div>
                <div class="col-span-2">
                    <InputLabel for="description" value="Description" />
                    <Textarea
                        id="description"
                        v-model="formExperience.description"
                        type="text"
                        placeholder="Description"
                        rows="6"
                    />
                    <InputError class="mt-2" :message="formExperience.errors.description" />
                </div>
                <div>
                    <InputLabel for="start_at" value="Start" />
                    <TextInput
                        id="start_at"
                        v-model="formExperience.start_at"
                        type="text"
                        placeholder="Start at"
                        autofocus
                    />
                    <InputError class="mt-2" :message="formExperience.errors.start_at" />
                </div>
                <div>
                    <InputLabel for="end_at" value="End" />
                    <TextInput
                        id="end_at"
                        v-model="formExperience.end_at"
                        type="text"
                        placeholder="End at"
                        autofocus
                    />
                    <InputError class="mt-2" :message="formExperience.errors.end_at" />
                </div>
            </template>
            <template #actions>
                <div class="flex justify-end items-center space-x-4">
                    <PrimaryButton :class="{ 'opacity-25': formExperience.processing }" :disabled="formExperience.processing">Save</PrimaryButton>
                </div>
            </template>
        </Form>
        <Table :rows="userExperiences.data" :columns="columns" :actions="actions"
            @onEdit="onEdit" @onDelete="onDelete"
            />
        <Pagination :links="userExperiences.links" :meta="userExperiences.meta"/>
            <FlowbiteModal id="deleteExperienceModal" title="Confirm delete" @close="closeDeleteModal">
                <Form @submitted="doDelete">
                    <template #form>
                        <TextInput
                            id="deletedExperienceId"
                            v-model="formDelete.id"
                            type="hidden"
                        />
                        <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this experience?</p>
                    </template>
                    <template #actions>
                        <div class="flex justify-end items-center space-x-4">
                            <SecondaryButton type="button" @click="closeDeleteModal">Cancel</SecondaryButton>
                            <PrimaryButton :class="{ 'opacity-25': formDelete.processing }" :disabled="formDelete.processing">Yes</PrimaryButton>
                        </div>
                    </template>
                </Form>
            </FlowbiteModal>
    </div>
</template>
