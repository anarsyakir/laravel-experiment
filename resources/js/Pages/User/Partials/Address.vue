<script setup>
import { useForm } from '@inertiajs/vue3';
import Form from '@/Components/Flowbite/Form.vue';
import TextInput from '@/Components/Flowbite/Form/TextInput.vue';
import InputLabel from '@/Components/Flowbite/Form/InputLabel.vue';
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    address: Object,
});

const formAddress = useForm({
    address_line: props.address?.address_line,
    country: props.address?.country,
    province: props.address?.province,
    city: props.address?.city,
    district: props.address?.district
});

const updateAddress = () => {
    formAddress.post(route('user-address.store'), {
        preserveScroll: true,
        onSuccess: () => showMessage(),
    });
};

const showMessage = () => {
    console.log('Success');
};

const resetForm = () => {
    formAddress.reset();
};

</script>

<template>
    <div class="grid gap-4 mb-4">
        <Form @submitted="updateAddress">
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
</template>
