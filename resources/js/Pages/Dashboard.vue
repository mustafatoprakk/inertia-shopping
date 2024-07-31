<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { useToast } from "vue-toastification";
import { useCountCartItem } from "@/stores/cartCount.js"

const toast = useToast();

defineProps({
    products: Array
})

const cartItem = useCountCartItem()
const form = cartItem.form
const addToCart = async (productId) => {
    cartItem.addToCart(productId)
}
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-32">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 m-10">
                        <div v-for="product in products" :key="product.id"
                            class="flex flex-col items-center justify-center w-full max-w-sm mx-auto">
                            <div
                                class="w-full h-64 bg-gray-300 bg-center bg-cover rounded-lg shadow-md hover:shadow-2xl transition duration-300">

                                <img class="w-full h-64 max-w-xl rounded-lg" :src="`/products/${product.image}`"
                                    alt="image description">
                            </div>
                            <div
                                class="w-56 -mt-10 overflow-hidden bg-white rounded-lg shadow-lg hover:shadow-2xl transition duration-300 md:w-64 dark:bg-gray-800">
                                <h3
                                    class="py-2 font-bold tracking-wide text-center text-gray-800 uppercase dark:text-white">
                                    {{ product.name }}</h3>

                                <div class="flex items-center justify-between px-3 py-2 bg-gray-200 dark:bg-gray-700">
                                    <span class="font-bold text-gray-800 dark:text-gray-200">${{ product.price }}</span>
                                    <button @click="addToCart(product.id)"
                                        class="px-2 py-1 text-xs font-semibold text-white uppercase transition-colors duration-300 transform bg-gray-800 rounded hover:bg-gray-700 dark:hover:bg-gray-600 focus:bg-gray-700 dark:focus:bg-gray-600 focus:outline-none">Add
                                        to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
