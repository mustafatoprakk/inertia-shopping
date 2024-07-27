<template>

    <Head title="Category" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Category</h2>
        </template>

        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-12 lg:px-16">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <AddCategory />
                        <ListCategory :categories="categories" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ListCategory from "@/Pages/Category/ListCategory.vue"
import AddCategory from "@/Pages/Category/AddCategory.vue"

defineProps({
    categories: Array
})
</script>
