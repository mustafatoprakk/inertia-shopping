import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const toast = useToast();

export const useCategoryStore = defineStore("category", {
    state: () => ({
        form: useForm({
            name: "",
            description: "",
        }),
    }),
    actions: {
        // Create category
        async onSubmit() {
            try {
                await this.form.post(route("category.store"));
                this.form.reset();
                toast.success("Category successfully created.", {
                    timeout: 3000,
                });
            } catch (error) {
                console.log(error);
            }
        },

        // Update category
        async onUpdate(categoryId) {
            try {
                await this.form.update(route("category.update", categoryId));
                toast.success("Category successfully updated", {
                    timeout: 3000,
                });
            } catch (error) {
                console.log(error);
            }
        },
    },
});
