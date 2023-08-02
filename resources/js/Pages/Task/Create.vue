<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Dropdown from "@/Components/Dropdown.vue";

const form = useForm({
    title: '',
    description: '',
    deadline: '',
    assign_to: '',
});

const submit = () => {
    form.post(route('tasks.store'), {
        onFinish: () => form.reset('title','description','deadline','assign_to'),
    });
};

defineProps({
    users:Object,
});
</script>
<template>
    <Head title="Create New Task" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New Task</h2>
        </template>


        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="title" value="Title" />

                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div class="mt-4">
                <InputLabel for="description" value="Description" />

                <textarea
                    id="description"
                    type="textarea"
                    class="mt-1 block w-full"
                    v-model="form.description"
                    required
                />
                <InputError class="mt-2" :message="form.errors.description" />
            </div>
            <div class="mt-4">
                <InputLabel for="deadline" value="Deadline" />

                <TextInput
                    id="deadline"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.deadline"
                    required
                />
                <InputError class="mt-2" :message="form.errors.deadline" />
            </div>
            <div class="mt-4">
                <InputLabel for="assign_to" value="Assign To" />

                <select id="assign_to" v-model="form.assign_to" type="select" class="mt-1 block w-full">
                    <option v-for="(user) in users" v-bind:value="user.id">{{ user.name }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.assign_to" />
            </div>


            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Create Task
                </PrimaryButton>
            </div>
        </form>
        </div>

    </AuthenticatedLayout>

</template>
