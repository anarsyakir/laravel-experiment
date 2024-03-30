<script setup>
import { watch, ref } from 'vue';
import Card from '@/Components/Flowbite/Card.vue';
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import SecondaryButton from '@/Components/Flowbite/Button/Secondary.vue';
import Toast from '@/Components/Flowbite/Toast.vue';
import FormVacancy from './Partial/FormVacancy.vue';
import FormVacancyAssessment from './Partial/FormVacancyAssessment.vue';
import FormAssessmentCriteria from './Partial/FormAssessmentCriteria.vue';

const props = defineProps({
    companies: Object,
    positions: Object,
    vacancy: Object,
    assessments: Object,
    criterias: Object,
});

const breadcrumb = [
    {name: "Home", href:route('dashboard')},
    {name: "Vacancy", href:route('vacancy.admin')},
    {name: "Create new vacancy", href:null},
];

const toastMessage = ref(null);
const alertType = ref(null);

const showAlert = (message, type) => {
    toastMessage.value = message;
    alertType.value = type;
    const element = document.getElementById('toast');
    element.classList.remove('ease-out', 'opacity-0', 'hidden');
    element.classList.add('ease-in');
    setTimeout(function(){
        const element = document.getElementById('toast');
        element.classList.remove('ease-in');
        element.classList.add('ease-out', 'opacity-0', 'hidden');
    }, 2000);
}

const alertSuccess = () => {
    showAlert('Data saved!', 'success');
}

const step = ref(1);

const nextStep = () => {
    if (step.value < 3) {
        step.value++;
    }
};

const prevStep = () => {
    if (step.value > 1) {
        step.value--;
    }
};

watch(step, async (newStep, oldStep) => {
    if(newStep > oldStep){
        const element = document.getElementById('step-'+newStep);
        element.classList.add('text-primary-600', 'dark:text-primary-500', 'after:border-primary-100', 'dark:after:border-primary-800');
        for (let i = 0; i < element.children.length; i++) {
            const child = element.children[i];
            child.classList.add('bg-primary-100', 'dark:bg-primary-800');
        }
    } else {
        const element = document.getElementById('step-'+oldStep);
        element.classList.remove('text-primary-600', 'dark:text-primary-500', 'after:border-primary-100', 'dark:after:border-primary-800');
        for (let i = 0; i < element.children.length; i++) {
            const child = element.children[i];
            child.classList.remove('bg-primary-100', 'dark:bg-primary-800');
        }
    }
});

</script>
<template>
    <FlowbiteLayout title="Vacancy Detail" :breadcrumb="breadcrumb">
        <Card class="p-4">
            <template #content>
                <ol class="flex items-center w-full mb-4 sm:mb-5">
                    <li class="flex w-full items-center text-primary-600 dark:text-primary-500 after:content-[''] after:w-full after:h-1 after:border-b after:border-primary-100 after:border-4 after:inline-block dark:after:border-primary-800" id="step-1">
                        <div class="flex items-center justify-center w-10 h-10 bg-primary-100 rounded-full lg:h-12 lg:w-12 dark:bg-primary-800 shrink-0">
                            <svg class="w-4 h-4 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z"/>
                            </svg>
                        </div>
                    </li>
                    <li class="flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block dark:after:border-gray-700" id="step-2">
                        <div class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700 shrink-0">
                            <svg class="w-4 h-4 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                <path d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM2 12V6h16v6H2Z"/>
                                <path d="M6 8H4a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2Zm8 0H9a1 1 0 0 0 0 2h5a1 1 0 1 0 0-2Z"/>
                            </svg>
                        </div>
                    </li>
                    <li class="flex items-center" id="step-3">
                        <div class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700 shrink-0">
                            <svg class="w-4 h-4 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z"/>
                            </svg>
                        </div>
                    </li>
                </ol>
                <div v-if="vacancy && !vacancy.is_valid" class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Error</span>
                    <div>
                        <span class="font-bold">Ensure that these requirements are met:</span>
                        <ul class="mt-1.5 list-disc list-inside">
                            <li v-if="vacancy && vacancy.assessments.length == 0">One vacancy must have minimum 1 assessment.</li>
                            <li v-if="vacancy && vacancy.assessments_weight !== 100">Total weight of assessments must be 100.</li>
                            <template v-for="crit in vacancy.assessments">
                                <li v-if="crit.criterias.length == 0">Assessment "{{ crit.assessment.name }}" must have minimum 1 criteria</li>
                                <li v-if="crit.criterias_weight !== 100">Total criteria weight of assessments "{{ crit.assessment.name }}" must be 100.</li>
                            </template>
                            <li><b>If one of the requirement does not meet, vacancy will not published.</b></li>
                        </ul>
                    </div>
                </div>
                <div v-if="vacancy && vacancy.is_valid && vacancy.status_code !== 1" class="flex p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Warning</span>
                    <div>
                        <span class="font-bold">Vacancy is valid but not published</span>
                    </div>
                </div>

                <div v-if="step == 1" class="mx-auto">
                    <FormVacancy :companies="companies" :positions="positions" :vacancy="vacancy" @alertSuccess="alertSuccess" @nextStep="nextStep"/>
                </div>
                <div v-if="step == 2" class="mx-auto">
                    <FormVacancyAssessment :vacancy="vacancy" :assessments="assessments" @alertSuccess="alertSuccess" @nextStep="nextStep" @prevStep="prevStep"/>
                </div>
                <div v-if="step == 3" class="mx-auto">
                    <FormAssessmentCriteria :vacancy="vacancy" :criterias="criterias" @alertSuccess="alertSuccess" @prevStep="prevStep"/>
                </div>
            </template>
        </Card>
    </FlowbiteLayout>
    <Toast :message="toastMessage" :alertType="alertType"/>
</template>