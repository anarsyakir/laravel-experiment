<script setup>

import Card from '@/Components/Flowbite/Card.vue';
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import Form from '@/Components/Flowbite/Form.vue';
import InputLabel from '@/Components/Flowbite/Form/InputLabel.vue';
import FileInput from '@/Components/Flowbite/Form/FileInput.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    vacancy: Object
});

console.log(props.vacancy);

const breadcrumb = [
    {name: "Home", href:route('dashboard')},
    {name: "Vacancy", href:route('vacancies.index')},
    {name: "Apply", href:null},
];

const needInput = {};

for(let i = 0; i < props.vacancy.criteriaNeedInput.length; i++){
    needInput[props.vacancy.criteriaNeedInput[i].id.toLowerCase().split('-').join('_')] = '';
}

needInput._method = 'PUT';
needInput.vacancy_id = props.vacancy.id;

const formApply = useForm(needInput);

const applyVacancy = () => {
    formApply.post(route('applicant.apply'), {
        errorBag: 'applyVacancy',
        preserveScroll: true,
        onSuccess: () => resetForm(),
    });
};

const resetForm = () => {

}

const onChange = (id, input) => {
    formApply[id] = input.value.files[0];
}

</script>
<template>
    <FlowbiteLayout title="Apply to Vacancy" :breadcrumb="breadcrumb">
        <Card class="p-4">
            <template #content>
                <div class="mx-auto">
                    <h2 class="mb-2 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">{{ vacancy.position.name }} at {{ vacancy.company.name }}</h2>
                    <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
                    <dl>
                        <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Please complete this requirements.</dt>
                    </dl>
                    <Form col="sm:grid-cols-3" @submited="">
                        <template #form>
                            <div v-for="inputs in vacancy.criteriaNeedInput">
                                <InputLabel :for="inputs.id.toLowerCase().split('-').join('_')" :value="inputs.name" />
                                <FileInput :id="inputs.id.toLowerCase().split('-').join('_')" @on-change="onChange"/>
                                <InputError class="mt-2" :message="formApply.errors[inputs.id.toLowerCase().split('-').join('_')]" />
                            </div>
                        </template>
                        <template #actions>
                            <div class="flex justify-end items-center space-x-4">
                                <PrimaryButton :class="{ 'opacity-25': formApply.processing }" :disabled="formApply.processing" @click="applyVacancy">Submit Application
                                </PrimaryButton>
                            </div>
                        </template>
                    </Form>
                </div>
            </template>
        </Card>
    </FlowbiteLayout>
</template>