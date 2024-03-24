<script setup>
import { onMounted, ref, watch } from 'vue';
import { initFlowbite } from 'flowbite';
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

const props = defineProps({
    vacancy: Object,
    criterias: Object,
});

const emit = defineEmits(['alertSuccess', 'nextStep', 'prevStep']);

const form = useForm({
    id: '',
    vacancy_assessment_id: '',
    criteria_id: '',
    treshold: '',
    weight: '',
    publish: '',
    reference: '',
});

const submit = () => {
    if(form.id != ''){
        form
        .transform((data) => ({
            ...data,
            publish: data.publish ? '1' : '0',
        }))
        .put(route('assessment-criteria.update', { 'assessment-criterion' : form.id}), {
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

const onSuccess = () => {
    emit('alertSuccess');
    form.reset();
    resetSelectNCheckbox();
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
    { field: 'publish', text: 'publish', action: false },
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
    
    const element = document.getElementById('criteria-'+e.target.value);
    element.classList.remove('hidden');
}

const resetSelectNCheckbox = () => {
    const children = document.getElementById('assessment').children;
    for (var i = 0; i < children.length; i++) {
        children[i].removeAttribute('selected');
    }
    const checkbox = document.getElementById('count_by_average');
    checkbox.checked = false;
}

const onEdit = (data) => {
    // form.id = '' + data.id;
    // form.assessment_id = data.assessment.id;
    // form.sequence = '' + data.sequence;
    // form.treshold  = '' + data.treshold;
    // form.weight = '' + data.weight;
    // form.count_by_average = data.count_by_average;
    // const children = document.getElementById('assessment').children;
    // for (var i = 0; i < children.length; i++) {
    //     if(children[i].value == data.assessment.id) {
    //         children[i].setAttribute('selected', true);
    //     } else {
    //         children[i].removeAttribute('selected');
    //     }
    // }
    // const checkbox = document.getElementById('count_by_average');
    // checkbox.checked = data.count_by_average == 1 ? true : false;
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
                <InputLabel for="assessment" value="Assessment" />
                <SelectInput
                    id="assessment"
                    v-model="form.vacancy_assessment_id"
                    @change="onAssessmentChange"
                >
                    <option>Choose assessment</option>
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
                >
                    <option>Choose criteria</option>
                    <template v-for="criteria in criterias">
                        <option :value="criteria.id">{{ criteria.name }}</option>
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
        </template>
    </Form>
    <template v-for="vcassessment in vacancy.assessments">
        <Table class="criteria hidden" :id="'criteria-'+vcassessment.id" :rows="vcassessment.criterias" :columns="columns" :actions="actions"
            @onEdit="onEdit"
        />
    </template>
    <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
    <div class="flex justify-end items-center space-x-4">
        <SecondaryButton @click="prevStep">Previous</SecondaryButton>
        <PrimaryButton @click="submit">Save</PrimaryButton>
    </div>
</template>