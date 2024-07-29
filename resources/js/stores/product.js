import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const toast = useToast();

export const useProductStore = defineStore("product", {
    state: () => ({
        form: useForm({
            category_id: null,
            name: null,
            description: null,
            stock: null,
            price: null,
            image: null,
        }),
    }),
    actions: {
        // Create product
        async createProduct() {
            try {
                await this.form.post(route("product.store"));
                this.form.reset();
                toast.success("Product successfully created", {
                    timeout: 3000,
                });
            } catch (error) {
                console.log(error);
            }
        },
    },
});
