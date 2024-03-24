<script setup>
import { onMounted, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Form from '@/Components/Flowbite/Form.vue';
import TextInput from '@/Components/Flowbite/Form/TextInput.vue';
import InputLabel from '@/Components/Flowbite/Form/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import SelectInput from '@/Components/Flowbite/Form/SelectInput.vue';
import Datepicker from 'flowbite-datepicker/Datepicker';
import Textarea from '@/Components/Flowbite/Form/Textarea.vue';
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';

const props = defineProps({
    companies: Object,
    positions: Object,
    vacancy: Object,
});

const emit = defineEmits(['alertSuccess', 'nextStep']);

const form = useForm({
    id: '',
    company_id: '',
    position_id: '',
    description: '',
    max_applicant: '',
    start_at: '',
    end_at: '',
});

const start_at = ref(null);
const end_at = ref(null);

if(props.vacancy){
    form.id = props.vacancy.id;
    form.company_id = props.vacancy.company.id;
    form.position_id = props.vacancy.position.id;
    form.description = props.vacancy.description;
    form.max_applicant = props.vacancy.max_applicant?.toString();
    form.start_at = props.vacancy.start_at;
    form.end_at = props.vacancy.end_at;
}

const submit = () => {
    form.start_at = start_at.value.getDate('yyyy-mm-dd');
    form.end_at = end_at.value.getDate('yyyy-mm-dd');
    if(form.id != ''){
        form.put(route('vacancies.update', { vacancy : form.id}), {
            onSuccess: () => onSuccess(),
        });
    } else {
        form.post(route('vacancies.store'), {
            onSuccess: () => onSuccess(),
        });
    }
};

const onSuccess = () => {
    emit('alertSuccess');
    emit('nextStep');
}

onMounted(() => {
    const startAt = document.getElementById('start_at');
    start_at.value = new Datepicker(startAt, {format: 'yyyy-mm-dd'});
    const endAt = document.getElementById('end_at');
    end_at.value = new Datepicker(endAt, {format: 'yyyy-mm-dd'}); 
});
</script>

<template>
    <h3 class="mb-2 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">Vacancy Information</h3>
    <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
    <Form @submitted="submit" col="sm:grid-cols-3">
        <template #form>
            <TextInput
                id="id"
                v-model="form.id"
                type="hidden"
            />
            <div>
                <InputLabel for="company" value="Company" />
                <SelectInput
                    id="company"
                    v-model="form.company_id"
                >
                    <option>Choose company</option>
                    <template v-for="company in companies">
                        <option v-if="vacancy && vacancy.company.id == company.id" :value="company.id" selected>{{ company.name }}</option>
                        <option v-else="vacancy && vacancy.company.id == company.id" :value="company.id">{{ company.name }}</option>
                    </template>
                </SelectInput>
                <InputError class="mt-2" :message="form.errors.company_id" />
            </div>
            <div>
                <InputLabel for="position" value="Position" />
                <SelectInput
                    id="position"
                    v-model="form.position_id"
                >
                    <option>Choose position</option>
                    <template v-for="position in positions">
                        <option v-if="vacancy && vacancy.position.id == position.id" :value="position.id" selected>{{ position.name }}</option>
                        <option v-else="vacancy && vacancy.position.id == position.id" :value="position.id">{{ position.name }}</option>
                    </template>
                </SelectInput>
                <InputError class="mt-2" :message="form.errors.position_id" />
            </div>
            <div>
                <InputLabel for="max_applicant" value="Max applicant" />
                <TextInput
                    id="max_applicant"
                    v-model="form.max_applicant"
                    type="number"
                    placeholder="Max applicant"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.max_applicant" />
            </div>
            <div>
                <InputLabel for="start_at" value="Start" />
                <TextInput
                    id="start_at"
                    v-model="form.start_at"
                    type="text"
                    placeholder="Start at"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.start_at" />
            </div>
            <div>
                <InputLabel for="end_at" value="End" />
                <TextInput
                    id="end_at"
                    v-model="form.end_at"
                    type="text"
                    placeholder="End at"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.end_at" />
            </div>
            <div class="col-span-3">
                <InputLabel for="description" value="Description" />
                <Textarea
                    id="description"
                    v-model="form.description"
                    type="text"
                    placeholder="Description"
                    rows="6"
                />
                <InputError class="mt-2" :message="form.errors.description" />
            </div>
            <!-- <Wysiwyg class="col-span-3">
                <div class="px-4 py-2 bg-white rounded-b-lg dark:bg-gray-800">
                    
                </div>
            </Wysiwyg> -->
        </template>
        <template #actions>
            <div class="flex justify-end items-center space-x-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Next</PrimaryButton>
            </div>
        </template>
    </Form>
</template>