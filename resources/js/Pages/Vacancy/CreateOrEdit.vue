<script setup>
import { onMounted, watch, ref } from 'vue';
import Card from '@/Components/Flowbite/Card.vue';
import PrimaryButton from '@/Components/Flowbite/Button/Primary.vue';
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import { useForm } from '@inertiajs/vue3';
import Form from '@/Components/Flowbite/Form.vue';
import TextInput from '@/Components/Flowbite/Form/TextInput.vue';
import InputLabel from '@/Components/Flowbite/Form/InputLabel.vue';
import SecondaryButton from '@/Components/Flowbite/Button/Secondary.vue';
import InputError from '@/Components/InputError.vue';
import SelectInput from '@/Components/Flowbite/Form/SelectInput.vue';
import Datepicker from 'flowbite-datepicker/Datepicker';
import Wysiwyg from '@/Components/Flowbite/Form/Wysiwyg.vue';
import Textarea from '@/Components/Flowbite/Form/Textarea.vue';
import Toast from '@/Components/Flowbite/Toast.vue';

const props = defineProps({
    companies: Object,
    positions: Object,
    vacancy: Object,
});

const breadcrumb = [
    {name: "Home", href:route('dashboard')},
    {name: "Vacancy", href:route('vacancy.admin')},
    {name: "Create new vacancy", href:null},
];

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
    form.max_applicant = props.vacancy.max_applicant.toString();
    form.start_at = props.vacancy.start_at;
    form.end_at = props.vacancy.end_at;
}

const toastMessage = ref(null);
const alertType = ref(null);

const showAlert = (message, type) => {
    toastMessage.value = message;
    alertType.value = type;
    const element = document.getElementById('toast');
    element.classList.remove('ease-out', 'opacity-0', 'hidden');
    element.classList.add('ease-in');
    setTimeout(function(){
        const element = document.getElementById('toast');
        element.classList.remove('ease-in');
        element.classList.add('ease-out', 'opacity-0', 'hidden');
    }, 2000);
}

const submit = () => {
    form.start_at = start_at.value.getDate('yyyy-mm-dd');
    form.end_at = end_at.value.getDate('yyyy-mm-dd');
    if(form.id != ''){
        form.put(route('vacancies.update', { vacancy : form.id}), {
            onSuccess: () => {
                showAlert('Data saved!', 'success');
                nextStep();
            },
        });
    } else {
        form.post(route('vacancies.store'), {
            onSuccess: () => {
                showAlert('Data saved!', 'success');
                nextStep();
            },
        });
    }
};

onMounted(() => {
    const startAt = document.getElementById('start_at');
    start_at.value = new Datepicker(startAt, {format: 'yyyy-mm-dd'});
    const endAt = document.getElementById('end_at');
    end_at.value = new Datepicker(endAt, {format: 'yyyy-mm-dd'}); 
});

const step = ref(1);

const nextStep = () => {
    if (step.value < 3) {
        step.value++;
    }
};

const prevStep = () => {
    if (step.value > 1) {
        step.value--;
    }
};

watch(step, async (newStep, oldStep) => {
    if(newStep > oldStep){
        const element = document.getElementById('step-'+newStep);
        element.classList.add('text-primary-600', 'dark:text-primary-500', 'after:border-primary-100', 'dark:after:border-primary-800');
        for (let i = 0; i < element.children.length; i++) {
            const child = element.children[i];
            child.classList.add('bg-primary-100', 'dark:bg-primary-800');
        }
    } else {
        const element = document.getElementById('step-'+oldStep);
        element.classList.remove('text-primary-600', 'dark:text-primary-500', 'after:border-primary-100', 'dark:after:border-primary-800');
        for (let i = 0; i < element.children.length; i++) {
            const child = element.children[i];
            child.classList.remove('bg-primary-100', 'dark:bg-primary-800');
        }
    }
});

</script>
<template>
    <FlowbiteLayout title="Vacancy Detail" :breadcrumb="breadcrumb">
        <Card class="p-4">
            <template #content>
                <ol class="flex items-center w-full mb-4 sm:mb-5">
                    <li class="flex w-full items-center text-primary-600 dark:text-primary-500 after:content-[''] after:w-full after:h-1 after:border-b after:border-primary-100 after:border-4 after:inline-block dark:after:border-primary-800" id="step-1">
                        <div class="flex items-center justify-center w-10 h-10 bg-primary-100 rounded-full lg:h-12 lg:w-12 dark:bg-primary-800 shrink-0">
                            <svg class="w-4 h-4 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z"/>
                            </svg>
                        </div>
                    </li>
                    <li class="flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block dark:after:border-gray-700" id="step-2">
                        <div class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700 shrink-0">
                            <svg class="w-4 h-4 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                <path d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM2 12V6h16v6H2Z"/>
                                <path d="M6 8H4a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2Zm8 0H9a1 1 0 0 0 0 2h5a1 1 0 1 0 0-2Z"/>
                            </svg>
                        </div>
                    </li>
                    <li class="flex items-center" id="step-3">
                        <div class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700 shrink-0">
                            <svg class="w-4 h-4 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z"/>
                            </svg>
                        </div>
                    </li>
                </ol>
                <div v-if="step == 1" class="mx-auto">
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
                </div>
                <div v-if="step == 2" class="mx-auto">
                    <h3 class="mb-2 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">Assessment Information</h3>
                    <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
                    <div class="flex justify-end items-center space-x-4">
                        <SecondaryButton @click="prevStep">Previous</SecondaryButton>
                        <PrimaryButton @click="nextStep">Next</PrimaryButton>
                    </div>
                </div>
                <div v-if="step == 3" class="mx-auto">
                    <h3 class="mb-2 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">Criteria Information</h3>
                    <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
                    <div class="flex justify-end items-center space-x-4">
                        <SecondaryButton @click="prevStep">Previous</SecondaryButton>
                        <PrimaryButton @click="submit">Submit</PrimaryButton>
                    </div>
                </div>
            </template>
        </Card>
    </FlowbiteLayout>
    <Toast :message="toastMessage" :alertType="alertType"/>
</template>