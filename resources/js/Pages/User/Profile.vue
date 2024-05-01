<script setup>
import { useForm } from '@inertiajs/vue3';
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import UpdateUser from './Partials/UpdateUser.vue';
import PersonalInformation from './Partials/PersonalInformation.vue';
import Address from './Partials/Address.vue';
import Education from './Partials/Education.vue';
import Experience from './Partials/Experience.vue';

const props = defineProps({
    profile: Object,
    address: Object,
    userEducations: Object,
    userExperiences: Object,
    educations: Object,
    majors: Object,
    positions: Object,
});

const breadcrumb = [
    {name: "Home", href:route('dashboard')},
    {name: "Profile", href:null},
];

</script>

<template>
    <FlowbiteLayout title="Manage User" :breadcrumb="breadcrumb">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-3">
                <UpdateUser :user="$page.props.auth.user"/>
            </div>
            <div class="col-span-9">
                <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="sm:hidden">
                        <label for="tabs" class="sr-only">Select tab</label>
                        <select id="tabs" class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>Personal</option>
                            <option>Address</option>
                            <option>Educations</option>
                            <option>Experiences</option>
                        </select>
                    </div>
                    <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400 rtl:divide-x-reverse" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
                        <li class="w-full">
                            <button id="personal-tab" data-tabs-target="#personal" type="button" role="tab" aria-controls="personal" aria-selected="true" class="inline-block w-full p-4 rounded-ss-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Personal</button>
                        </li>
                        <li class="w-full">
                            <button id="address-tab" data-tabs-target="#address" type="button" role="tab" aria-controls="address" aria-selected="false" class="inline-block w-full p-4 bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Address</button>
                        </li>
                        <li class="w-full">
                            <button id="education-tab" data-tabs-target="#education" type="button" role="tab" aria-controls="education" aria-selected="false" class="inline-block w-full p-4 rounded-se-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Educations</button>
                        </li>
                        <li class="w-full">
                            <button id="experience-tab" data-tabs-target="#experience" type="button" role="tab" aria-controls="experience" aria-selected="false" class="inline-block w-full p-4 rounded-se-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Experience</button>
                        </li>
                    </ul>
                    <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
                        <div class="hidden p-2 bg-white rounded-lg md:p-4 dark:bg-gray-800" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                            <PersonalInformation :profile="profile"/>
                        </div>
                        <div class="hidden p-2 bg-white rounded-lg md:p-4 dark:bg-gray-800" id="address" role="tabpanel" aria-labelledby="address-tab">
                            <Address :address="address"/>
                        </div>
                        <div class="hidden p-4 bg-white rounded-lg dark:bg-gray-800" id="education" role="tabpanel" aria-labelledby="education-tab">
                            <Education :user-educations="userEducations" :educations="educations" :majors="majors"/>
                        </div>
                        <div class="hidden p-4 bg-white rounded-lg dark:bg-gray-800" id="experience" role="tabpanel" aria-labelledby="experience-tab">
                            <Experience :user-experiences="userExperiences" :positions="positions"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </FlowbiteLayout>
</template>
