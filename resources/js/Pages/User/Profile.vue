<script setup>
import { ref } from 'vue';
import { Modal, initFlowbite } from 'flowbite';
import { useForm } from '@inertiajs/vue3';
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import Form from '@/Components/Flowbite/Form.vue';
import TextInput from '@/Components/Flowbite/Form/TextInput.vue';
import InputLabel from '@/Components/Flowbite/Form/InputLabel.vue';
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';
import SecondaryButton from '@/Components/Flowbite/Button/Secondary.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    user: Object
});

const breadcrumb = [
    {name: "Home", href:route('dashboard')},
    {name: "Manage Users", href:null},
];

const form = useForm({
    id: '',
    name: props.user.name,
    email: props.user.email,
    password: '',
    new_password: '',
    password_confirmation: '',
    terms: true,
});

const formPersonal = useForm({
    user_id: '',
    phone_number: '',
    birth_date: '',
    birth_place: ''
});

const formAddress = useForm({
    user_id: '',
    address_line: '',
    country: '',
    province: '',
    city: '',
    district: ''
});

const formMajor = useForm({
    user_id: '',
    institute: '',
    major: '',
    year: '',
    location: '',
    gpa: ''
});

const formExperience = useForm({
    user_id: '',
    company: '',
    position: '',
    period: '',
    location: ''
});

</script>

<template>
    <FlowbiteLayout title="Manage User" :breadcrumb="breadcrumb">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-3">
                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-end px-4 pt-3">
                        <button id="dropdownButton" data-dropdown-toggle="dropdown" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                            <span class="sr-only">Open dropdown</span>
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdown" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2" aria-labelledby="dropdownButton">
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Update profile</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex flex-col items-center pb-3">
                        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" :src="user.profile_photo_url" alt="Bonnie image"/>
                        <div class="flex mt-4 md:mt-6">
                            <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Select new photo</a>
                        </div>
                    </div>
                    <div class="items-center p-3">
                        <Form col="">
                            <template #form>
                                <TextInput
                                    id="id"
                                    v-model="form.id"
                                    type="hidden"
                                />
                                <div>
                                    <InputLabel for="name" value="Name" />
                                    <TextInput
                                        id="name"
                                        v-model="form.name"
                                        type="text"
                                        placeholder="User name"
                                        autofocus
                                    />
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>
                                <div>
                                    <InputLabel for="email" value="Email" />
                                    <TextInput
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        placeholder="User email"
                                        autofocus
                                    />
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>
                                <div>
                                    <InputLabel for="password" value="Current Password" />
                                    <TextInput
                                        id="password"
                                        v-model="form.password"
                                        type="password"
                                        placeholder="Left blank if unchanged"
                                        autofocus
                                    />
                                    <InputError class="mt-2" :message="form.errors.password" />
                                </div>
                                <div>
                                    <InputLabel for="password" value="New Password" />
                                    <TextInput
                                        id="new_password"
                                        v-model="form.new_password"
                                        type="password"
                                        placeholder="Left blank if unchanged"
                                        autofocus
                                    />
                                    <InputError class="mt-2" :message="form.errors.new_password" />
                                </div>
                                <div>
                                    <InputLabel for="password_confirmation" value="Confirm password" />
                                    <TextInput
                                        id="password_confirmation"
                                        v-model="form.password_confirmation"
                                        type="password"
                                        placeholder="Left blank if unchanged"
                                        autofocus
                                    />
                                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                </div>
                            </template>
                            <template #actions>
                                <div class="flex justify-end items-center space-x-4">
                                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</PrimaryButton>
                                </div>
                            </template>
                        </Form>
                    </div>
                </div>
            </div>
            <div class="col-span-9">
                <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="sm:hidden">
                        <label for="tabs" class="sr-only">Select tab</label>
                        <select id="tabs" class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>Personal</option>
                            <option>Address</option>
                            <option>Major</option>
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
                            <button id="major-tab" data-tabs-target="#major" type="button" role="tab" aria-controls="major" aria-selected="false" class="inline-block w-full p-4 rounded-se-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Major</button>
                        </li>
                        <li class="w-full">
                            <button id="experience-tab" data-tabs-target="#experience" type="button" role="tab" aria-controls="experience" aria-selected="false" class="inline-block w-full p-4 rounded-se-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Experience</button>
                        </li>
                    </ul>
                    <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
                        <div class="hidden p-2 bg-white rounded-lg md:p-4 dark:bg-gray-800" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                            <div class="grid gap-4 mb-4">
                                <Form>
                                    <template #form>
                                        <div>
                                            <InputLabel for="phone" value="Phone Number" />
                                            <TextInput
                                                id="phone"
                                                v-model="formPersonal.phone_number"
                                                type="text"
                                                placeholder="Phone number"
                                                autofocus
                                            />
                                            <InputError class="mt-2" :message="formPersonal.errors.phone_number" />
                                        </div>
                                        <div>
                                            <InputLabel for="birth_place" value="Birth Place" />
                                            <TextInput
                                                id="birth_place"
                                                v-model="formPersonal.birth_place"
                                                type="text"
                                                placeholder="Birth place"
                                                autofocus
                                            />
                                            <InputError class="mt-2" :message="formPersonal.errors.birth_place" />
                                        </div>
                                        <div>
                                            <InputLabel for="birth_date" value="Birth Date" />
                                            <TextInput
                                                id="birth_date"
                                                v-model="formPersonal.password"
                                                type="text"
                                                placeholder="Birth date"
                                                autofocus
                                            />
                                            <InputError class="mt-2" :message="formPersonal.errors.birth_date" />
                                        </div>
                                    </template>
                                    <template #actions>
                                        <div class="flex justify-end items-center space-x-4">
                                            <PrimaryButton :class="{ 'opacity-25': formPersonal.processing }" :disabled="formPersonal.processing">Save</PrimaryButton>
                                        </div>
                                    </template>
                                </Form>
                            </div>
                        </div>
                        <div class="hidden p-2 bg-white rounded-lg md:p-4 dark:bg-gray-800" id="address" role="tabpanel" aria-labelledby="address-tab">
                            <Form>
                                <template #form>
                                    <div>
                                        <InputLabel for="address_line" value="Address" />
                                        <TextInput
                                            id="address_line"
                                            v-model="formAddress.address_line"
                                            type="text"
                                            placeholder="Complete address"
                                            autofocus
                                        />
                                        <InputError class="mt-2" :message="formAddress.errors.address_line" />
                                    </div>
                                    <div>
                                        <InputLabel for="country" value="Country" />
                                        <TextInput
                                            id="country"
                                            v-model="formAddress.country"
                                            type="text"
                                            placeholder="Country"
                                            autofocus
                                        />
                                        <InputError class="mt-2" :message="formAddress.errors.country" />
                                    </div>
                                    <div>
                                        <InputLabel for="province" value="Province" />
                                        <TextInput
                                            id="province"
                                            v-model="formAddress.province"
                                            type="text"
                                            placeholder="Province"
                                            autofocus
                                        />
                                        <InputError class="mt-2" :message="formAddress.errors.province" />
                                    </div>
                                    <div>
                                        <InputLabel for="city" value="City" />
                                        <TextInput
                                            id="city"
                                            v-model="formAddress.city"
                                            type="text"
                                            placeholder="City"
                                            autofocus
                                        />
                                        <InputError class="mt-2" :message="formAddress.errors.city" />
                                    </div>
                                    <div>
                                        <InputLabel for="district" value="District" />
                                        <TextInput
                                            id="district"
                                            v-model="formAddress.district"
                                            type="text"
                                            placeholder="District"
                                            autofocus
                                        />
                                        <InputError class="mt-2" :message="formAddress.errors.district" />
                                    </div>
                                </template>
                                <template #actions>
                                    <div class="flex justify-end items-center space-x-4">
                                        <PrimaryButton :class="{ 'opacity-25': formAddress.processing }" :disabled="formAddress.processing">Save</PrimaryButton>
                                    </div>
                                </template>
                            </Form>
                        </div>
                        <div class="hidden p-4 bg-white rounded-lg dark:bg-gray-800" id="major" role="tabpanel" aria-labelledby="major-tab">
                            <Form>
                                <template #form>
                                    <div>
                                        <InputLabel for="name" value="Name" />
                                        <TextInput
                                            id="name"
                                            v-model="form.name"
                                            type="text"
                                            placeholder="User name"
                                            autofocus
                                        />
                                        <InputError class="mt-2" :message="form.errors.name" />
                                    </div>
                                    <div>
                                        <InputLabel for="email" value="Email" />
                                        <TextInput
                                            id="email"
                                            v-model="form.email"
                                            type="email"
                                            placeholder="User email"
                                            autofocus
                                        />
                                        <InputError class="mt-2" :message="form.errors.email" />
                                    </div>
                                    <div>
                                        <InputLabel for="password" value="Password" />
                                        <TextInput
                                            id="password"
                                            v-model="form.password"
                                            type="password"
                                            placeholder="User password"
                                            autofocus
                                        />
                                        <InputError class="mt-2" :message="form.errors.password" />
                                    </div>
                                    <div>
                                        <InputLabel for="password_confirmation" value="Confirm password" />
                                        <TextInput
                                            id="password_confirmation"
                                            v-model="form.password_confirmation"
                                            type="password"
                                            placeholder="Confirm password"
                                            autofocus
                                        />
                                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                    </div>
                                </template>
                                <template #actions>
                                    <div class="flex justify-end items-center space-x-4">
                                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</PrimaryButton>
                                    </div>
                                </template>
                            </Form>
                        </div>
                        <div class="hidden p-4 bg-white rounded-lg dark:bg-gray-800" id="experience" role="tabpanel" aria-labelledby="experience-tab">
                            <Form>
                                <template #form>
                                    <div>
                                        <InputLabel for="name" value="Name" />
                                        <TextInput
                                            id="name"
                                            v-model="form.name"
                                            type="text"
                                            placeholder="User name"
                                            autofocus
                                        />
                                        <InputError class="mt-2" :message="form.errors.name" />
                                    </div>
                                    <div>
                                        <InputLabel for="email" value="Email" />
                                        <TextInput
                                            id="email"
                                            v-model="form.email"
                                            type="email"
                                            placeholder="User email"
                                            autofocus
                                        />
                                        <InputError class="mt-2" :message="form.errors.email" />
                                    </div>
                                    <div>
                                        <InputLabel for="password" value="Password" />
                                        <TextInput
                                            id="password"
                                            v-model="form.password"
                                            type="password"
                                            placeholder="User password"
                                            autofocus
                                        />
                                        <InputError class="mt-2" :message="form.errors.password" />
                                    </div>
                                    <div>
                                        <InputLabel for="password_confirmation" value="Confirm password" />
                                        <TextInput
                                            id="password_confirmation"
                                            v-model="form.password_confirmation"
                                            type="password"
                                            placeholder="Confirm password"
                                            autofocus
                                        />
                                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                    </div>
                                </template>
                                <template #actions>
                                    <div class="flex justify-end items-center space-x-4">
                                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</PrimaryButton>
                                    </div>
                                </template>
                            </Form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </FlowbiteLayout>
</template>
