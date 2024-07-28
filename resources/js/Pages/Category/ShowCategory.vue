<template>

    <Head title="Update Category" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Update Category</h2>
        </template>


        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <span class="sm:inline-block sm:h-screen sm:align-middle">&#8203;</span>

                <div
                    class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl hover:shadow-2xl duration-300 dark:bg-gray-300 sm:my-8 sm:w-full sm:max-w-lg sm:p-6 sm:align-middle">
                    <h3
                        class="text-xl text-center mt-3 pb-5 font-medium leading-6 text-gray-800 capitalize dark:text-gray-900">
                        Update Category
                    </h3>

                    <form class="mt-4" @submit.prevent="onUpdate(category.id)">
                        <label class="block mt-3" for="name">
                            <input type="text" placeholder="Computer" v-model="form.name"
                                class="block w-full px-4 py-3 text-lg text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-300 dark:text-gray-900 dark:focus:border-blue-300 transition duration-300" />
                        </label>

                        <label class="block mt-3 pb-5" for="description">
                            <input type="text" placeholder="It is danger technology" v-model="form.description"
                                class="block w-full px-4 py-3 text-lg text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-300 dark:text-gray-900 dark:focus:border-blue-300 transition duration-300" />
                        </label>

                        <div class="mt-4 sm:flex sm:items-center sm:-mx-2 mb-2">
                            <Link :href="route('category.index')"
                                class="flex justify-center items-center ps-1 w-full px-4 py-3 text-md font-medium tracking-wide text-gray-200 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2 dark:text-gray-900 dark:border-gray-700 dark:hover:bg-gray-200 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left mr-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M15 6l-6 6l6 6" />
                            </svg>
                            <span>Back</span>
                            </Link>

                            <button type="submit"
                                class="flex justify-center w-full px-4 py-3 mt-3 text-md font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-rotate me-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M19.95 11a8 8 0 1 0 -.5 4m.5 5v-5h-5" />
                                </svg>
                                <span>Update</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useToast } from "vue-toastification";

const toast = useToast();


const props = defineProps({
    category: Object
})

const form = useForm({
    name: props.category.name,
    description: props.category.description
})

const onUpdate = async (categoryId) => {
    try {
        await form.put(route("category.update", categoryId));
        toast.success("Category successfully updated", {
            timeout: 3000,
        });
    } catch (error) {
        console.log(error);
    }
}
</script>
