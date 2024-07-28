<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-10">
        <div v-for="category in categories" :key="category.id"
            class=" w-full max-w-sm px-4 py-4  bg-white rounded-lg shadow-lg hover:shadow-2xl transition duration-500 dark:bg-blue-200">
            <h2
                class="text-center pt-4 text-3xl font-semibold text-gray-800 dark:text-gray-900 md:mt-0 transition-transform duration-500 ease-in-out hover:scale-110">
                {{ category.name }}</h2>

            <div class="flex justify-center mt-4">
                <!--edit-->
                <Link :href="route('category.show', category.id)"
                    class="text-lg font-medium text-blue-600 dark:text-gray-700 hover:dark:text-blue-700 me-1"
                    tabindex="0" role="link">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                </Link>
                <!--delete-->
                <button type="button" @click="deleteCategory(category.id)"
                    class="text-lg font-medium text-blue-600 dark:text-gray-700 hover:dark:text-blue-700" tabindex="0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

</template>

<script setup>
import { Link, router, useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { useToast } from "vue-toastification";

const toast = useToast();
const form = useForm({})

defineProps({
    categories: Array
})

// delete
const deleteCategory = async (categoryId) => {
    try {
        if (confirm('Are you sure you want to delete this category?')) {
            await form.delete(route('category.delete', categoryId));
            toast.success("Category successfully deleted.", {
                timeout: 3000,
            });
        }
    } catch (error) {
        console.error(error);
        toast.error("There was an error deleting the category.", {
            timeout: 3000,
        });
    }
}
</script>