<script setup>
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import Form from '@/Components/Flowbite/Form.vue';
import TextInput from '@/Components/Flowbite/Form/TextInput.vue';
import InputLabel from '@/Components/Flowbite/Form/InputLabel.vue';
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';
import SecondaryButton from '@/Components/Flowbite/Button/Secondary.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'PUT',
    name: props.user.name,
    email: props.user.email,
    current_password: '',
    password: '',
    password_confirmation: '',
    terms: true,
    photo: null,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route('profile.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    router.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    form.current_password = '';
    form.password = '';
    form.password_confirmation = '';

    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>

<template>
    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-end px-4 pt-3">
            <button id="dropdownButton" data-dropdown-toggle="dropdown"
                class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                type="button">
                <span class="sr-only">Open dropdown</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 16 3">
                    <path
                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdown"
                class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2" aria-labelledby="dropdownButton">
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Update
                            profile</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col items-center pb-3">
            <input
                id="photo"
                ref="photoInput"
                type="file"
                class="hidden"
                @change="updatePhotoPreview"
            >
            <div v-show="! photoPreview">
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" :src="user.profile_photo_url" alt="image" />
            </div>

            <!-- New Profile Photo Preview -->
            <div v-show="photoPreview" class="mt-2">
                <span
                    class="block rounded-full w-24 h-24 bg-cover bg-no-repeat bg-center"
                    :style="'background-image: url(\'' + photoPreview + '\');'"
                />
            </div>
            <div class="flex mt-4 md:mt-6">
                <SecondaryButton
                    v-if="user.profile_photo_path"
                    type="button"
                    class="mr-2"
                    @click="deletePhoto"
                >
                    Remove
                </SecondaryButton>
                <PrimaryButton @click="selectNewPhoto">Select new</PrimaryButton>
            </div>
        </div>
        <div class="items-center p-3">
            <Form col="" @submited="">
                <template #form>
                    <div>
                        <InputLabel for="name" value="Name" />
                        <TextInput id="name" v-model="form.name" type="text" placeholder="User name" autofocus />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div>
                        <InputLabel for="email" value="Email" />
                        <TextInput id="email" v-model="form.email" type="email" placeholder="User email" autofocus />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div>
                        <InputLabel for="password" value="Current Password" />
                        <TextInput id="password" v-model="form.current_password" type="password"
                            placeholder="Left blank if unchanged" autofocus />
                        <InputError class="mt-2" :message="form.errors.current_password" />
                    </div>
                    <div>
                        <InputLabel for="password" value="New Password" />
                        <TextInput id="new_password" v-model="form.password" type="password"
                            placeholder="Left blank if unchanged" autofocus />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
                    <div>
                        <InputLabel for="password_confirmation" value="Confirm password" />
                        <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                            placeholder="Left blank if unchanged" autofocus />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>
                </template>
                <template #actions>
                    <div class="flex justify-end items-center space-x-4">
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="updateProfileInformation">Save
                        </PrimaryButton>
                    </div>
                </template>
            </Form>
        </div>
    </div>
</template>
