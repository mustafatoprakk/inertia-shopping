<template>

    <Head title="Cart" />

    <AuthenticatedLayout :totalQuantity="totalQuantity">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cart</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-12 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <section class="bg-white p-8 antialiased dark:bg-gray-0 md:py-16 shadow-lg border border-gray-100">
                        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-900 sm:text-2xl">
                                Shopping Cart</h2>
                            <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">

                                <!--cart item-->
                                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                                    <div class="space-y-6">
                                        <div v-for="cartItem in cartItemTotals" :key="cartItem.id"
                                            class="rounded-lg border border-gray-200 bg-white p-4 shadow-md hover:shadow-xl transition duration-300 dark:border-gray-200 dark:bg-gray-200 md:p-6">

                                            <div v-if="cartItem.product"
                                                class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                                <a href="#" class="shrink-0 md:order-1">
                                                    <img class="h-30 w-40 dark:block"
                                                        :src="`/products/${cartItem.product.image}`" alt="imac image" />
                                                </a>

                                                <label for="counter-input" class="sr-only">Choose quantity:</label>
                                                <div
                                                    class="flex items-center justify-between md:order-3 md:justify-end">
                                                    <div class="flex items-center">
                                                        <!--decrement button-->
                                                        <button @click="cartItemCountDecrement(cartItem.id)"
                                                            type="button" id="decrement-button"
                                                            data-input-counter-decrement="counter-input"
                                                            class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                            <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 18 2">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M1 1h16" />
                                                            </svg>
                                                        </button>
                                                        <input type="text" id="counter-input" data-input-counter
                                                            class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-white focus:outline-none focus:ring-0 dark:text-gray-900"
                                                            placeholder="" :value="cartItem.quantity" required />
                                                        <!--increment button-->
                                                        <button @click="cartItemCountIncrement(cartItem.id)"
                                                            type="button" id="increment-button"
                                                            data-input-counter-increment="counter-input"
                                                            class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                            <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 18 18">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M9 1v16M1 9h16" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="text-end md:order-4 md:w-32">
                                                        <p class="text-lg font-bold text-gray-300 dark:text-gray-900">
                                                            ${{ cartItem.product.price }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                                    <a href="#"
                                                        class="text-base font-medium text-gray-300 hover:underline dark:text-gray-800">
                                                        {{ cartItem.product.name }}
                                                    </a>

                                                    <div class="flex items-center gap-4">
                                                        <button type="button"
                                                            class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 hover:underline dark:text-gray-500 dark:hover:text-gray-700">
                                                            <svg class="me-1.5 h-5 w-5" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                                            </svg>
                                                            Add to Favorites
                                                        </button>

                                                        <button type="button"
                                                            class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                                            <svg class="me-1.5 h-5 w-5" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M6 18 17.94 6M18 18 6.06 6" />
                                                            </svg>
                                                            Remove
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--result-->
                                <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                                    <div
                                        class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-md hover:shadow-xl transition duration-300 dark:border-gray-200 dark:bg-gray-200 sm:p-6">
                                        <p class="text-xl font-semibold text-gray-200 dark:text-gray-900">Order summary
                                        </p>

                                        <div class="space-y-4">
                                            <div class="space-y-2">
                                                <dl class="flex items-center justify-between gap-4">
                                                    <dt class="text-base font-normal text-gray-300 dark:text-gray-700">
                                                        Original price</dt>
                                                    <dd class="text-base font-medium text-gray-900 dark:text-gray-700">
                                                        ${{ totalPrice }}</dd>
                                                </dl>

                                                <dl class="flex items-center justify-between gap-4">
                                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-700">
                                                        Shipping cost
                                                    </dt>
                                                    <dd class="text-base font-medium text-gray-900 dark:text-gray-700">
                                                        $10
                                                    </dd>
                                                </dl>
                                            </div>

                                            <dl
                                                class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                                <dt class="text-base font-bold text-gray-900 dark:text-gray-700">Total
                                                </dt>
                                                <dd class="text-base font-bold text-gray-900 dark:text-gray-700">
                                                    ${{ totalPrice + 10 }}</dd>
                                            </dl>
                                        </div>

                                        <div class="flex items-center justify-center gap-2 pt-3">
                                            <a href="#" title=""
                                                class="inline-flex items-center gap-2 text-md font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                                                Continue Shopping
                                                <svg class="h-5 w-5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M19 12H5m14 0-4 4m4-4-4-4" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>


                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { computed, ref, watch } from 'vue';

const props = defineProps({
    cartItems: Array,
    totalPrice: Number
});

// Lokal state'ler oluşturma
const cartItemTotals = ref(props.cartItems);
const totalPrice = ref(props.totalPrice);

// Toplam quantity hesaplama
const totalQuantity = computed(() => {
    return cartItemTotals.value.reduce((sum, item) => sum + item.quantity, 0);
});

// sepetteki ürünün miktarını artırma
const cartItemCountIncrement = async (cartId) => {
    try {
        await axios.post(route('cart.increment', cartId));

        const response = await axios.get(route('cart.get.index'))
        // Yerel state'leri güncelleme
        cartItemTotals.value = response.data.cartItems;
        totalPrice.value = response.data.totalPrice;
    } catch (error) {
        console.log(error);
    }
};

// sepetteki ürünün miktarını azaltma
const cartItemCountDecrement = async (cartId) => {
    try {
        await axios.post(route('cart.decrement', cartId));

        const response = await axios.get(route('cart.get.index'))
        // Yerel state'leri güncelleme
        cartItemTotals.value = response.data.cartItems;
        totalPrice.value = response.data.totalPrice;
    } catch (error) {
        console.log(error);
    }
};

// ürün listesini güncelleme

</script>