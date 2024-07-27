<template>
    <div class="flex justify-end">
        <button @click="isOpen = !isOpen"
            class="px-6 py-4 tracking-wide text-lg text-white capitalize transition-colors duration-300 transform bg-gray-700 rounded-md hover:bg-gray-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80 flex items-center space-x-2">
            <span>Create New Category</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
        </button>

        <div v-if="isOpen" class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <span class="sm:inline-block sm:h-screen sm:align-middle">&#8203;</span>

                <div
                    class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl hover:shadow-2xl duration-300 dark:bg-gray-300 sm:my-8 sm:w-full sm:max-w-md sm:p-6 sm:align-middle">
                    <h3
                        class="text-xl text-center mt-3 pb-5 font-medium leading-6 text-gray-800 capitalize dark:text-gray-900">
                        New Category
                    </h3>

                    <form @submit.prevent="createCategory()" class="mt-4">
                        <label class="block mt-3" for="name">
                            <input type="text" v-model="form.name" placeholder="Computer"
                                class="block w-full px-4 py-3 text-lg text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-300 dark:text-gray-900 dark:focus:border-blue-300 transition duration-300" />
                        </label>

                        <label class="block mt-3 pb-5" for="description">
                            <input type="text" v-model="form.description" placeholder="It is danger technology"
                                class="block w-full px-4 py-3 text-lg text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-300 dark:text-gray-900 dark:focus:border-blue-300 transition duration-300" />
                        </label>

                        <div class="mt-4 sm:flex sm:items-center sm:-mx-2 mb-2">
                            <button type="button" @click="isOpen = !isOpen"
                                class="w-full px-4 py-3 text-md font-medium tracking-wide text-gray-200 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2 dark:text-gray-900 dark:border-gray-700 dark:hover:bg-gray-200 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                                Cancel
                            </button>

                            <button type="submit"
                                class="w-full px-4 py-3 mt-3 text-md font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                                Create Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useCategoryStore } from "@/stores/category.js"

const isOpen = ref(false)

const categoryStore = useCategoryStore()
const form = categoryStore.form

const createCategory = () => {
    categoryStore.onSubmit()
    isOpen.value = !isOpen.value
}
</script>