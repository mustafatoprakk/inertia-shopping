<template>
    <div class="flex justify-end">
        <button @click="isOpen = !isOpen"
            class="px-6 py-4 tracking-wide text-lg text-white capitalize transition-colors duration-300 transform bg-gray-700 rounded-md hover:bg-gray-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80 flex items-center space-x-2">
            <span>Create New Product</span>
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
                    class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl hover:shadow-2xl duration-300 dark:bg-gray-300 sm:my-8 sm:w-full sm:max-w-xl sm:p-6 sm:align-middle">
                    <h3
                        class="text-xl text-center mt-3 pb-5 font-medium leading-6 text-gray-800 capitalize dark:text-gray-900">
                        New Product
                    </h3>

                    <form @submit.prevent="createNewProduct" class="mt-4">
                        <!--category id-->
                        <label class="block mt-3" for="category">
                            <select id="category" v-model="form.category_id"
                                class="block w-full px-4 py-3 text-lg text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-300 dark:text-gray-900 dark:focus:border-blue-300 transition duration-300">
                                <option value="" disabled selected>Choose a category</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </label>
                        <!--name-->
                        <label class="block mt-4" for="name">
                            <input type="text" v-model="form.name" placeholder="Product name"
                                class="block w-full px-4 py-3 text-lg text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-300 dark:text-gray-900 dark:focus:border-blue-300 transition duration-300" />
                        </label>
                        <!--description-->
                        <label class="block mt-4" for="description">
                            <input type="text" v-model="form.description" placeholder="Description"
                                class="block w-full px-4 py-3 text-lg text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-300 dark:text-gray-900 dark:focus:border-blue-300 transition duration-300" />
                        </label>
                        <!--Stock-->
                        <label class="block mt-4" for="stock">
                            <input type="number" v-model="form.stock" placeholder="Stock"
                                class="block w-full px-4 py-3 text-lg text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-300 dark:text-gray-900 dark:focus:border-blue-300 transition duration-300" />
                        </label>
                        <!--Price-->
                        <label class="block mt-4" for="price">
                            <input type="number" v-model="form.price" placeholder="Price"
                                class="block w-full px-4 py-3 text-lg text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-300 dark:text-gray-900 dark:focus:border-blue-300 transition duration-300" />
                        </label>
                        <!--image-->
                        <label class="block mt-4 pb-5" for="image">
                            <input @input="form.image = $event.target.files[0]"
                                class="block w-full text-xl text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-300 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="image" type="file">
                        </label>

                        <div class="mt-4 sm:flex sm:items-center sm:-mx-2 mb-2">
                            <button type="button" @click="isOpen = !isOpen"
                                class="flex justify-center w-full px-4 py-3 mt-3 text-md font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-gray-500 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-gray-600 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="currentColor"
                                    class="icon icon-tabler icons-tabler-filled icon-tabler-circle-x me-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-6.489 5.8a1 1 0 0 0 -1.218 1.567l1.292 1.293l-1.292 1.293l-.083 .094a1 1 0 0 0 1.497 1.32l1.293 -1.292l1.293 1.292l.094 .083a1 1 0 0 0 1.32 -1.497l-1.292 -1.293l1.292 -1.293l.083 -.094a1 1 0 0 0 -1.497 -1.32l-1.293 1.292l-1.293 -1.292l-.094 -.083z" />
                                </svg>
                                <span>Cancel</span>
                            </button>
                            <button type="submit"
                                class="flex justify-center w-full px-4 py-3 mt-3 text-md font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-rotate me-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M19.95 11a8 8 0 1 0 -.5 4m.5 5v-5h-5" />
                                </svg>
                                <span>Create</span>
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
import { useProductStore } from "@/stores/product.js"

const isOpen = ref(false)

defineProps({
    categories: Array
})

const productStore = useProductStore()
const form = productStore.form

const createNewProduct = () => {
    productStore.createProduct();
    isOpen.value = !isOpen.value
}

// create product

</script>