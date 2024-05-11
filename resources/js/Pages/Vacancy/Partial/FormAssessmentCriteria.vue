<script setup>
import { onMounted, ref, watch } from 'vue';
import { initFlowbite, initDropdowns } from 'flowbite';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
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
    criterias: Object,
});

const reference = ref([]);

watch(reference, async (newReference, oldReference) => {
    const referenceOption = document.getElementById('reference');
    while (referenceOption.options.length > 0) {
        referenceOption.remove(0);
    }
    if(newReference.length > 0){
        referenceOption.parentElement.classList.remove('hidden');
        for(var i = 0; i < newReference.length; i++){
            const option = document.createElement("option");
            option.text = newReference[i];
            option.value = newReference[i];
            if(form.reference.includes(option.value)){
                option.selected = true;
            }
            referenceOption.add(option);
        }
    } else {
        referenceOption.parentElement.classList.add('hidden');
    }
})

const emit = defineEmits(['alertSuccess', 'nextStep', 'prevStep']);

const form = useForm({
    id: '',
    vacancy_assessment_id: '',
    criteria_id: '',
    treshold: '',
    weight: '',
    publish: '',
    reference: [],
    additional: [],
});

const formVacancy = useForm({
    id: props.vacancy.id
});

const submit = () => {
    if(form.id != ''){
        form
        .transform((data) => ({
            ...data,
            publish: data.publish ? '1' : '0',
        }))
        .put(route('assessment-criteria.update', { 'assessment_criteria' : form.id}), {
            onSuccess: () => onSuccess(),
        });
    } else {
        form
        .transform((data) => ({
            ...data,
            publish: data.publish ? '1' : '0',
        }))
        .post(route('assessment-criteria.store'), {
            onSuccess: () => onSuccess(),
        });
    }
};

const publishVacancy = () => {
    formVacancy.put(route('vacancies.publish', { vacancy : formVacancy.id}), {
        onSuccess: () => onSuccess(),
    });
}

const onSuccess = () => {
    emit('alertSuccess');
    form.reset();
    formVacancy.reset();
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
    { field: ['criteria', 'name'], text: 'Criteria Name', action: false },
    { field: 'treshold', text: 'Treshold', action: false },
    { field: 'weight', text: 'Weight', action: false },
    { field: 'publish', text: 'Published', action: false },
    { field: 'reference', text: 'Reference', action: false },
    { field: 'action', text: 'Action', action: true },
]);

const actions = ref([
    { name: 'Edit', emit: 'onEdit'},
    { name: 'Delete', emit: 'onDelete'},
]);

const onAssessmentChange = (e) => {
    const table = document.getElementsByClassName('criteria');
    for (let i = 0; i < table.length; i++) {
        table[i].classList.add('hidden');
    }

    if(e.target.value == '') return;
    
    const element = document.getElementById('criteria-'+e.target.value);
    element.classList.remove('hidden');
}

const onCriteriaChange = (e) => {
    const selectedOption = e.target.options[e.target.selectedIndex];
    const name = selectedOption.getAttribute('data-reference');
    const config = selectedOption.getAttribute('data-config');
    if(name){
        axios.post(route('reference', {name: name}))
        .then((response) => {
            reference.value = response.data;
        });
    } else {
        reference.value = [];
        form.reference = [];
    }

    if(config){
        const conf = JSON.parse(config);
        for (var i=0; i<conf.length; i++) {
            const inputE = document.createElement()
        }
    }
}

const onReferenceChange = (e) => {
    form.reference = [];
    const options = e.target.options;
    for (var i=0; i<options.length; i++) {
        const opt = options[i];
        if (opt.selected) {
            form.reference.push(opt.value);
        }
    }
}

const resetSelectNCheckbox = () => {
    const element = document.getElementById('criteria');
    const childrenCriteria = element.children;
    for (var i = 0; i < childrenCriteria.length; i++) {
        if(childrenCriteria[i].value == '') {
            childrenCriteria[i].setAttribute('selected', true);
        } else {
            childrenCriteria[i].removeAttribute('selected');
        }
    }

    const event = new Event('change');
    element.dispatchEvent(event);

    const checkbox = document.getElementById('publish');
    checkbox.checked = false;
}

const onEdit = (data) => {
    form.id = '' + data.id;
    form.vacancy_assessment_id = data.vacancy_assessment_id;
    form.criteria_id = data.criteria.id;
    form.treshold  = '' + data.treshold;
    form.weight = '' + data.weight;
    form.publish = data.publish;
    form.reference = data.reference;
    
    const element = document.getElementById('criteria');
    const childrenCriteria = element.children;
    for (var i = 0; i < childrenCriteria.length; i++) {
        if(childrenCriteria[i].value == data.criteria.id) {
            childrenCriteria[i].setAttribute('selected', true);
        } else {
            childrenCriteria[i].removeAttribute('selected');
        }
    }

    const event = new Event('change');
    element.dispatchEvent(event);

    const checkbox = document.getElementById('publish');
    checkbox.checked = data.publish == 1 ? true : false;
}

const formDelete = useForm({
    id: ''
});

const onDelete = (data) => {
    formDelete.id = '' + data.id;
    openDeleteModal();
}

const doDelete = () => {
    formDelete.delete(route('assessment-criteria.destroy', {assessment_criteria: formDelete.id}), {
        onSuccess: () => closeDeleteModal(),
    });
}

const openDeleteModal = () => {
    const targetEl = document.getElementById('deleteCriteriaModal');
    const modal = new Modal(targetEl, {closable: false});
    modal.show();
}

const closeDeleteModal = () => {
    const targetEl = document.getElementById('deleteCriteriaModal');
    const modal = new Modal(targetEl, {closable: false});
    modal.hide();
    formDelete.reset();
}

onMounted(() => {
    initFlowbite();
});
</script>

<template>
    <h3 class="mb-2 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">Assessment Criteria</h3>
    <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
    <Form @submitted="submit" col="sm:grid-cols-6">
        <template #form>
            <TextInput
                id="id"
                v-model="form.id"
                type="hidden"
            />
            <div>
                <InputLabel for="vassessment" value="Assessment" />
                <SelectInput
                    id="vassessment"
                    v-model="form.vacancy_assessment_id"
                    @change="onAssessmentChange"
                >
                    <option value="">Choose assessment</option>
                    <template v-for="va in vacancy.assessments">
                        <option :value="va.id">{{ va.assessment.name }}</option>
                    </template>
                </SelectInput>
                <InputError class="mt-2" :message="form.errors.vacancy_assessment_id" />
            </div>
            <div>
                <InputLabel for="criteria" value="Criteria" />
                <SelectInput
                    id="criteria"
                    v-model="form.criteria_id"
                    @change="onCriteriaChange"
                >
                    <option value="">Choose criteria</option>
                    <template v-for="criteria in criterias">
                        <option :data-config="criteria.config" :data-reference="criteria.reference" :value="criteria.id">{{ criteria.name }}</option>
                    </template>
                </SelectInput>
                <InputError class="mt-2" :message="form.errors.vacancy_assessment_id" />
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
                <InputLabel for="publish" value="Publish?" />
                <label class="inline-flex items-center cursor-pointer">
                    <Checkbox id="publish" v-model="form.publish" class="sr-only peer"/>
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600"></div>
                </label>
                <!-- <TextInput
                    id="publish"
                    v-model="form.publish"
                    type="text"
                    placeholder="Publish?"
                    autofocus
                /> -->
                <InputError class="mt-2" :message="form.errors.publish" />
            </div>
            <div>
                <InputLabel value="&nbsp;"/>
                <PrimaryButton class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</PrimaryButton>
            </div>
            <div class="hidden">
                <InputLabel for="reference" value="Criteria Reference" />
                <select multiple="true" @change="onReferenceChange" id="reference" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="">Choose reference</option>
                </select>
                <InputError class="mt-2" :message="form.errors.reference" />
            </div>
            <div id="additional">

            </div>
        </template>
    </Form>
    <template v-for="vcassessment in vacancy.assessments">
        <Table class="criteria hidden" :id="'criteria-'+vcassessment.id" :rows="vcassessment.criterias" :columns="columns" :actions="actions"
            @onEdit="onEdit" @onDelete="onDelete"
        />
    </template>
    <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
    <div class="flex justify-end items-center space-x-4">
        <SecondaryButton @click="prevStep">Previous</SecondaryButton>
        <PrimaryButton @click="publishVacancy">Publish</PrimaryButton>
    </div>
    <FlowbiteModal id="deleteCriteriaModal" title="Confirm delete" @close="closeDeleteModal">
        <Form @submitted="doDelete">
            <template #form>
                <TextInput
                    id="deletedId"
                    v-model="formDelete.id"
                    type="hidden"
                />
                <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this criteria?</p>
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