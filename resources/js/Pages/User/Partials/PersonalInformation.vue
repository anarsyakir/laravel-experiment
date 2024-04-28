<script setup>
import { useForm } from '@inertiajs/vue3';
import Form from '@/Components/Flowbite/Form.vue';
import TextInput from '@/Components/Flowbite/Form/TextInput.vue';
import InputLabel from '@/Components/Flowbite/Form/InputLabel.vue';
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    profile: Object,
});

const formPersonal = useForm({
    phone_number: props.profile?.phone_number,
    birth_date: props.profile?.birth_date,
    birth_place: props.profile?.birth_place
});

const updatePersonalInformation = () => {
    
    formPersonal.post(route('user-profile.store'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => showMessage(),
    });
};

const showMessage = () => {
    console.log('Success');
};

const resetForm = () => {
    formPersonal.reset();
};

</script>

<template>
    <div class="grid gap-4 mb-4">
        <Form @submitted="updatePersonalInformation">
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
                        v-model="formPersonal.birth_date"
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
</template>
