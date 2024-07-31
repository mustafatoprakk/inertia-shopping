import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { ref } from "vue";

const toast = useToast();

export const useCountCartItem = defineStore("category", {
    state: () => ({
        count: 0,
        form: useForm({
            product_id: null,
        }),
    }),
    actions: {
        // total quantity
        async countCartItem() {
            try {
                const response = await axios.get(route("cart.count"));
                this.count = response.data.totalQuantity;
            } catch (error) {
                console.log(error);
            }
        },

        // sepete ürün ekleme
        async addToCart(productId) {
            try {
                await this.form.post(
                    route("product.cart", [(this.form.product_id = productId)])
                );
                toast.success("Product added to cart", {
                    timeout: 3000,
                });
                this.countCartItem();
            } catch (error) {
                console.log(error);
            }
        },
    },
});
