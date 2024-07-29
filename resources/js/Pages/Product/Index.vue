<template>

    <Head title="Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Product</h2>
        </template>

        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-12 lg:px-16">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <AddProduct :categories="categories" />
                        <ListProduct :products="products" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import AddProduct from "./AddProduct.vue"
import ListProduct from "./ListProduct.vue"

defineProps({
    products: Array,
    categories: Array
});
</script>
