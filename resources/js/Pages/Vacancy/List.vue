<script setup>

import Card from '@/Components/Flowbite/Card.vue';
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import Header from '@/Components/Flowbite/Header.vue';
import Pagination from '@/Components/Flowbite/Table/Pagination.vue';

const props = defineProps({
    vacancies: Object
});

</script>
<template>
    <FlowbiteLayout title="Vacancy List">
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
                        <dd class="mb-1 text-gray-500 md:text-sm dark:text-gray-400 col-span-5">{{ criteria.reference ? criteria.reference.join('/') : crieria.treshold }}</dd>
                    </div>
                </dl>
            </template>
            <template #button>
                <PrimaryButton>Apply</PrimaryButton>
            </template>
        </Card>
        <Card>
            <template #content>
                <Pagination :links="vacancies.links" :meta="vacancies.meta"/>
            </template>
        </Card>
    </FlowbiteLayout>
</template>