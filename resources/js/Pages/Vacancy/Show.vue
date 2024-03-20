<script setup>

import Card from '@/Components/Flowbite/Card.vue';
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';

const props = defineProps({
    vacancy: Object
});

</script>
<template>
    <FlowbiteLayout title="Vacancy Detail">
        <Card class="p-4">
            <template #content>
                <div class="mx-auto">
                    <h2 class="mb-2 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">{{ vacancy.position.name }} at {{ vacancy.company.name }}</h2>
                    <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
                    <dl>
                        <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Details</dt>
                        <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ vacancy.description }}</dd>
                    </dl>
                    <dl class="flex items-center">
                        <div class="mr-4" v-for="criteria in vacancy.publishedCriteria">
                            <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">{{ criteria.criteria.name }}</dt>
                            <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ criteria.reference ? criteria.reference.join('/') : crieria.treshold }}</dd>
                        </div>
                    </dl>
                </div>
            </template>
            <template #button>
                <PrimaryButton>Apply</PrimaryButton>
            </template>
        </Card>
    </FlowbiteLayout>
</template>