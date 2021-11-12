<template>
    <jet-form-section @submitted="createOrder">
        <template #title>Create Order</template>

        <template #description> Create a new customer order. </template>

        <template #form>
            <div class="col-span-6">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="col-span-1">
                        <jet-label for="date" value="Order Date" />
                        <jet-input
                            id="date"
                            type="date"
                            class="mt-1 block w-full"
                            v-model="form.date"
                            required
                        />
                        <jet-input-error
                            :message="form.errors.date"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-1">
                        <select-box
                            labelValue="Customer"
                            :items="customers"
                            v-model="orderCustomer"
                        />
                        <jet-input-error
                            :message="form.errors.customer_id"
                            class="mt-2"
                        />
                    </div>
                </div>
            </div>
        </template>

        <template #actions>
            <jet-button
                type="submit"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                >New Order</jet-button
            >
        </template>
    </jet-form-section>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

import SelectBox from "@Components/SelectBox.vue";

export default {
    components: {
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        SelectBox,
    },

    data() {
        return {
            customers: this.$page.props.customers,
            orderCustomer: null,
            form: this.$inertia.form({
                _method: "POST",
                date: new Date().toISOString().slice(0, -14),
                customer_id: null,
                team_member_id: this.$page.props.user.id,
            }),
        };
    },
    watch: {
        orderCustomer() {
            if (this.orderCustomer) {
                this.form.customer_id = this.orderCustomer.id;
            } else {
                this.form.customer_id = null;
            }
        },
    },

    methods: {
        createOrder() {
            this.form.post(route("orders.store"), {
                errorBag: "createOrder",
                preserveScroll: true,
            });
        },
    },
};
</script>
