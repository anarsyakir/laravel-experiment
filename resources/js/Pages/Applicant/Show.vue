<script setup>

import Card from '@/Components/Flowbite/Card.vue';
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';

const props = defineProps({
    applicant: Object
});

const breadcrumb = [
    {name: "Home", href:route('dashboard')},
    {name: "Applicant", href:route('applicants.index')},
    {name: "Show", href:null},
];

const getClass = (index, arrLength) => {
    if(index == 0){
        return "flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700";
    } else if (index == (arrLength - 1)){
        return "flex items-center";
    } else {
        return "flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700"
    }
};

</script>
<template>
    <FlowbiteLayout title="Applicant" :breadcrumb="breadcrumb">
        <Card class="p-4">
            <template #content>
                <div class="mx-auto">
                    <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
                        <template v-for="(item, index) in applicant.vacancy.assessments">
                            <li :class="getClass(index, applicant.vacancy.assessments.length)">
                                <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                    </svg>
                                    {{ item.assessment.name }}
                                </span>
                            </li>
                        </template>
                        <!-- <li class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                            <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                                <span class="me-2">2</span>
                                Account <span class="hidden sm:inline-flex sm:ms-2">Info</span>
                            </span>
                        </li> -->
                    </ol>
                </div>
                <hr class="h-px mb-3 mt-4 bg-gray-200 border-0 dark:bg-gray-700">
                <dl class="text-gray-900 dark:text-white">
                    <div class="grid grid-cols-6 gap-4 pb-1">
                        <dt class="text-sm font-semibold">Ijazah</dt>
                        <dd class="mb-1 text-gray-500 md:text-sm dark:text-gray-400 col-span-5">Passed</dd>
                    </div>
                    <div class="grid grid-cols-6 gap-4 pb-1">
                        <dt class="text-sm font-semibold">SKCK</dt>
                        <dd class="mb-1 text-gray-500 md:text-sm dark:text-gray-400 col-span-5">Not Pass</dd>
                    </div>
                </dl>
            </template>
        </Card>
    </FlowbiteLayout>
</template>