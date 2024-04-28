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

const props = defineProps({
    userEducations: Object,
    educations: Object,
    majors: Object,
});

const formEducation = useForm({
    id: '',
    education_id: '',
    major_id: '',
    school: '',
    gpa: '',
    year: ''
});

const addEducation = () => {
    if(formEducation.id != ''){
        formEducation.put(route('user-education.update', { user_education : formEducation.id}), {
            onSuccess: () => showMessage(),
        });
    } else {
        formEducation.post(route('user-education.store'), {
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
    formEducation.reset();
    resetSelectNCheckbox();
};

const onEdit = (data) => {
    formEducation.id = '' + data.id;
    formEducation.education_id = data.education.id;
    formEducation.major_id = '' + data.major.id;
    formEducation.school  = '' + data.school;
    formEducation.gpa = '' + data.gpa;
    formEducation.year = data.year;
    const children = document.getElementById('educationx').children;
    for (var i = 0; i < children.length; i++) {
        if(children[i].value == data.education.id) {
            children[i].setAttribute('selected', true);
        } else {
            children[i].removeAttribute('selected');
        }
    }
    const children2 = document.getElementById('major').children;
    for (var i = 0; i < children2.length; i++) {
        if(children2[i].value == data.major.id) {
            children2[i].setAttribute('selected', true);
        } else {
            children2[i].removeAttribute('selected');
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
    formDelete.delete(route('user-education.destroy', {user_education: formDelete.id}), {
        onSuccess: () => closeDeleteModal(),
    });
}

const openDeleteModal = () => {
    const targetEl = document.getElementById('deleteEducationModal');
    const modal = new Modal(targetEl, {closable: false});
    modal.show();
}

const closeDeleteModal = () => {
    const targetEl = document.getElementById('deleteEducationModal');
    const modal = new Modal(targetEl, {closable: false});
    modal.hide();
    formDelete.reset();
}

const resetSelectNCheckbox = () => {
    const children = document.getElementById('educationx').children;
    for (var i = 0; i < children.length; i++) {
        children[i].removeAttribute('selected');
    }
    const children2 = document.getElementById('major').children;
    for (var i = 0; i < children2.length; i++) {
        children2[i].removeAttribute('selected');
    }
}

const columns = ref([
    { field: ['education', 'name'], text: 'Education Name', action: false },
    { field: ['major', 'name'], text: 'Education Name', action: false },
    { field: 'gpa', text: 'GPA', action: false },
    { field: 'school', text: 'School', action: false },
    { field: 'year', text: 'Year', action: false },
    { field: 'action', text: 'Action', action: true },
]);

const actions = ref([
    { name: 'Edit', emit: 'onEdit'},
    { name: 'Delete', emit: 'onDelete'},
]);

onMounted(() => {
    initFlowbite();
});

</script>

<template>
    <div class="grid gap-4 mb-4">
        <Form @submitted="addEducation" col="sm:grid-cols-3">
            <template #form>
                <TextInput
                    id="id"
                    v-model="formEducation.id"
                    type="hidden"
                />
                <div>
                    <InputLabel for="educationx" value="Education" />
                    <SelectInput
                        id="educationx"
                        v-model="formEducation.education_id"
                    >
                        <option>Choose education</option>
                        <template v-for="education in educations">
                            <option :value="education.id">{{ education.name }}</option>
                        </template>
                    </SelectInput>
                    <InputError class="mt-2" :message="formEducation.errors.education_id" />
                </div>
                <div>
                    <InputLabel for="major" value="Major" />
                    <SelectInput
                        id="major"
                        v-model="formEducation.major_id"
                    >
                        <option>Choose major</option>
                        <template v-for="major in majors">
                            <option :value="major.id">{{ major.name }}</option>
                        </template>
                    </SelectInput>
                    <InputError class="mt-2" :message="formEducation.errors.major_id" />
                </div>
                <div>
                    <InputLabel for="school" value="School" />
                    <TextInput
                        id="school"
                        v-model="formEducation.school"
                        type="text"
                        placeholder="School"
                        autofocus
                    />
                    <InputError class="mt-2" :message="formEducation.errors.school" />
                </div>
                <div>
                    <InputLabel for="gpa" value="GPA" />
                    <TextInput
                        id="gpa"
                        v-model="formEducation.gpa"
                        type="number"
                        step="0.01"
                        placeholder="GPA"
                        autofocus
                    />
                    <InputError class="mt-2" :message="formEducation.errors.gpa" />
                </div>
                <div>
                    <InputLabel for="year" value="Year" />
                    <TextInput
                        id="year"
                        v-model="formEducation.year"
                        type="number"
                        placeholder="Year"
                        autofocus
                    />
                    <InputError class="mt-2" :message="formEducation.errors.year" />
                </div>
            </template>
            <template #actions>
                <div class="flex justify-end items-center space-x-4">
                    <PrimaryButton :class="{ 'opacity-25': formEducation.processing }" :disabled="formEducation.processing">Save</PrimaryButton>
                </div>
            </template>
        </Form>
        <Table :rows="userEducations.data" :columns="columns" :actions="actions"
            @onEdit="onEdit" @onDelete="onDelete"
            />
        <Pagination :links="userEducations.links" :meta="userEducations.meta"/>
            <FlowbiteModal id="deleteEducationModal" title="Confirm delete" @close="closeDeleteModal">
                <Form @submitted="doDelete">
                    <template #form>
                        <TextInput
                            id="deletedId"
                            v-model="formDelete.id"
                            type="hidden"
                        />
                        <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this education?</p>
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
