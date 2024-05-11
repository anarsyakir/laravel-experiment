<script setup>

import Card from '@/Components/Flowbite/Card.vue';
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import Header from '@/Components/Flowbite/Header.vue';
import Pagination from '@/Components/Flowbite/Table/Pagination.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    vacancies: Object
});

console.log(props.vacancies);

const breadcrumb = [
    {name: "Home", href:route('dashboard')},
    {name: "Vacancy", href:null},
];

const toApply = (id) => {
    router.get(route('vacancy.apply', { vacancy : id}));
}

</script>
<template>
    <FlowbiteLayout title="Vacancy List" :breadcrumb="breadcrumb">
        <Header/>
        <Card v-for="vacancy in vacancies.data" :title="vacancy.position.name" :link="route('vacancies.show', { vacancy : vacancy.id})" class="p-4">
            <template #content>
                <dl class="text-gray-900 dark:text-white">
                    <div class="grid grid-cols-6 gap-4 pb-1">
                        <dt class="text-sm font-semibold">Company</dt>
                        <dd class="mb-1 text-gray-500 md:text-sm dark:text-gray-400 col-span-5">{{ vacancy.company.name }}</dd>
                    </div>
                    <div class="grid grid-cols-6 gap-4 pb-1">
                        <dt class="text-sm font-semibold">Field</dt>
                        <dd class="mb-1 text-gray-500 md:text-sm dark:text-gray-400 col-span-5">{{ vacancy.company.field.name }}</dd>
                    </div>
                    <div v-for="criteria in vacancy.publishedCriteria" class="grid grid-cols-6 gap-4 pb-1">
                        <dt class="text-sm font-semibold">{{ criteria.criteria.name }}</dt>
                        <dd class="mb-1 text-gray-500 md:text-sm dark:text-gray-400 col-span-5">{{ criteria.reference ? criteria.reference.join('/') : criteria.treshold }}</dd>
                    </div>
                </dl>
            </template>
            <template #button>
                <PrimaryButton v-if="!vacancy.is_applied" @click="toApply(vacancy.id)">Apply</PrimaryButton>
                <PrimaryButton v-else :disabled="true">Applied</PrimaryButton>
            </template>
        </Card>
        <Card>
            <template #content>
                <Pagination :links="vacancies.links" :meta="vacancies.meta"/>
            </template>
        </Card>
    </FlowbiteLayout>
</template>