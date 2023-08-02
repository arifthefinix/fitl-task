<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps({
    tasks:Object,
});
</script>
<template>
    <Head title="Tasks" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tasks</h2>
        </template>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class=" text-left text-sm font-light">
                                        <thead class="border-b font-medium dark:border-neutral-500">
                                        <tr>
                                            <th scope="col" class="px-6 py-4">#</th>
                                            <th scope="col" class="px-6 py-4">Title</th>
                                            <th scope="col" class="px-6 py-4">Status</th>
                                            <th scope="col" class="px-6 py-4">Description</th>
                                            <th scope="col" class="px-6 py-4">Deadline</th>
                                            <th scope="col" class="px-6 py-4">Assign By</th>
                                            <th scope="col" class="px-6 py-4">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="border-b dark:border-neutral-500" v-for="(task,key) in tasks">
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ ++key}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ task.title}}</td>
                                            <td class="whitespace-nowrap px-6 py-4" v-if="task.status==1">Open</td>
                                            <td class="whitespace-nowrap px-6 py-4" v-if="task.status==2">In-progress</td>
                                            <td class="whitespace-nowrap px-6 py-4" v-if="task.status==3">Done</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ task.description}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ task.deadline}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ task.assigner_info.name}}</td>
                                            <td>
                                                <Link :href="route('task.start',task.id)" v-if="task.status==1" class="text-white bg-blue-500 border py-2 px-4">Start Task</Link>
                                                <Link :href="route('task.done',task.id)" v-if="task.status==2" class="text-white bg-blue-500 border py-2 px-4">Done</Link>
                                                <h4 v-if="task.status==3">Done</h4>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
