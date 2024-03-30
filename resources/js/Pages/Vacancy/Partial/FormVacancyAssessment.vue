<script setup>
import { onMounted, ref } from 'vue';
import { initFlowbite, initDropdowns } from 'flowbite';
import { useForm } from '@inertiajs/vue3';
import Form from '@/Components/Flowbite/Form.vue';
import TextInput from '@/Components/Flowbite/Form/TextInput.vue';
import InputLabel from '@/Components/Flowbite/Form/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import SelectInput from '@/Components/Flowbite/Form/SelectInput.vue';
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';
import SecondaryButton from '@/Components/Flowbite/Button/Secondary.vue';
import Table from '@/Components/Flowbite/Table.vue';
import Checkbox from '@/Components/Flowbite/Form/Checkbox.vue';
import FlowbiteModal from '@/Components/Flowbite/Modal.vue';

const props = defineProps({
    vacancy: Object,
    assessments: Object,
});

const emit = defineEmits(['alertSuccess', 'nextStep', 'prevStep']);

const form = useForm({
    id: '',
    vacancy_id: props.vacancy.id,
    assessment_id: '',
    sequence: '',
    treshold: '',
    weight: '',
    count_by_average: '',
});

const submitVa = () => {
    if(form.id != ''){
        form
        .transform((data) => ({
            ...data,
            count_by_average: data.count_by_average ? '1' : '0',
        }))
        .put(route('vacancy-assessment.update', { vacancy_assessment : form.id}), {
            onSuccess: () => onSuccess(),
            onError: (e) => error.log(e)
        });
    } else {
        form
        .transform((data) => ({
            ...data,
            count_by_average: data.count_by_average ? '1' : '0',
        }))
        .post(route('vacancy-assessment.store'), {
            onSuccess: () => onSuccess(),
        });
    }
};

const onSuccess = () => {
    emit('alertSuccess');
    form.reset();
    resetSelectNCheckbox();
    initDropdowns();
}

const prevStep = () => {
    emit('prevStep');
}

const nextStep = () => {
    emit('nextStep');
}

const columns = ref([
    { field: ['assessment', 'name'], text: 'Assessment Name', action: false },
    { field: 'sequence', text: 'Sequence', action: false },
    { field: 'treshold', text: 'Treshold', action: false },
    { field: 'weight', text: 'Weight', action: false },
    { field: 'count_by_average', text: 'Average?', action: false },
    { field: 'action', text: 'Action', action: true },
]);

const actions = ref([
    { name: 'Edit', emit: 'onEdit'},
    { name: 'Delete', emit: 'onDelete'},
]);

const resetSelectNCheckbox = () => {
    const children = document.getElementById('assessment').children;
    for (var i = 0; i < children.length; i++) {
        if(children[i].value == '') {
            children[i].setAttribute('selected', true);
        } else {
            children[i].removeAttribute('selected');
        }
    }
    const checkbox = document.getElementById('count_by_average');
    checkbox.checked = false;
}

const onEdit = (data) => {
    form.id = '' + data.id;
    form.assessment_id = data.assessment.id;
    form.sequence = '' + data.sequence;
    form.treshold  = '' + data.treshold;
    form.weight = '' + data.weight;
    form.count_by_average = data.count_by_average;
    const children = document.getElementById('assessment').children;
    for (var i = 0; i < children.length; i++) {
        if(children[i].value == data.assessment.id) {
            children[i].setAttribute('selected', true);
        } else {
            children[i].removeAttribute('selected');
        }
    }
    const checkbox = document.getElementById('count_by_average');
    checkbox.checked = data.count_by_average == 1 ? true : false;
}

const formDelete = useForm({
    id: ''
});

const onDelete = (data) => {
    formDelete.id = '' + data.id;
    openDeleteModal();
}

const doDelete = () => {
    formDelete.delete(route('vacancy-assessment.destroy', {vacancy_assessment: formDelete.id}), {
        onSuccess: () => closeDeleteModal(),
    });
}

const openDeleteModal = () => {
    const targetEl = document.getElementById('deleteVassessmentModal');
    const modal = new Modal(targetEl, {closable: false});
    modal.show();
}

const closeDeleteModal = () => {
    const targetEl = document.getElementById('deleteVassessmentModal');
    const modal = new Modal(targetEl, {closable: false});
    modal.hide();
    formDelete.reset();
}

onMounted(() => {
    initFlowbite();
});

</script>

<template>
    <h3 class="mb-2 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">Assessment Information</h3>
    <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
    <Form @submitted="submitVa" col="sm:grid-cols-6">
        <template #form>
            <TextInput
                id="id"
                v-model="form.id"
                type="hidden"
            />
            <div>
                <InputLabel for="assessment" value="Assessment" />
                <SelectInput
                    id="assessment"
                    v-model="form.assessment_id"
                >
                    <option value="">Choose assessment to add</option>
                    <template v-for="assessment in assessments">
                        <option :value="assessment.id">{{ assessment.name }}</option>
                    </template>
                </SelectInput>
                <InputError class="mt-2" :message="form.errors.assessment_id" />
            </div>
            <div>
                <InputLabel for="sequence" value="Sequence" />
                <TextInput
                    id="sequence"
                    v-model="form.sequence"
                    type="number"
                    placeholder="Sequence"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.sequence" />
            </div>
            <div>
                <InputLabel for="treshold" value="Treshold" />
                <TextInput
                    id="treshold"
                    v-model="form.treshold"
                    type="number"
                    placeholder="Treshold"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.treshold" />
            </div>
            <div>
                <InputLabel for="weight" value="Weight" />
                <TextInput
                    id="weight"
                    v-model="form.weight"
                    type="number"
                    placeholder="Weight"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.treshold" />
            </div>
            <div>
                <InputLabel for="count_by_average" value="Count by average?" />
                <label class="inline-flex items-center cursor-pointer">
                    <Checkbox id="count_by_average" v-model="form.count_by_average" class="sr-only peer"/>
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600"></div>
                </label>
                <!-- <TextInput
                    id="count_by_average"
                    v-model="form.count_by_average"
                    type="text"
                    placeholder="Count by average?"
                    autofocus
                /> -->
                <InputError class="mt-2" :message="form.errors.count_by_average" />
            </div>
            <div>
                <InputLabel value="&nbsp;"/>
                <PrimaryButton class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</PrimaryButton>
            </div>
        </template>
    </Form>
    <Table :rows="vacancy.assessments" :columns="columns" :actions="actions"
    @onEdit="onEdit" @onDelete="onDelete"
    />
    <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
    <div class="flex justify-end items-center space-x-4">
        <SecondaryButton @click="prevStep">Previous</SecondaryButton>
        <PrimaryButton @click="nextStep">Next</PrimaryButton>
    </div>
    <FlowbiteModal id="deleteVassessmentModal" title="Confirm delete" @close="closeDeleteModal">
        <Form @submitted="doDelete">
            <template #form>
                <TextInput
                    id="deletedId"
                    v-model="formDelete.id"
                    type="hidden"
                />
                <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this assessment?</p>
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