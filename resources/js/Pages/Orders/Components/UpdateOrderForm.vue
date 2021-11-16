<template>
    <jet-form-section @submitted="updateOrder">
        <template #title>Update Order</template>

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
                            :selectedItem="orderCustomer"
                            v-model="orderCustomer"
                        />
                        <jet-input-error
                            :message="form.errors.customer_id"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-1">
                        <select-box
                            labelValue="Delivery Status"
                            :items="delivery_statuses"
                            :selectedItem="deliveryStatus"
                            v-model="deliveryStatus"
                        />
                        <jet-input-error
                            :message="form.errors.delivery_status_id"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-1">
                        <select-box
                            labelValue="Payment Status"
                            :items="payment_statuses"
                            :selectedItem="paymentStatus"
                            v-model="paymentStatus"
                        />
                        <jet-input-error
                            :message="form.errors.payment_status_id"
                            class="mt-2"
                        />
                    </div>
                </div>
            </div>
        </template>

        <template #actions>
            <jet-button
                type="submit"
                :class="{ 'opacity-25': form.processing || !form.isDirty }"
                :disabled="form.processing || !form.isDirty"
                >Save Order</jet-button
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

import SelectBox from "@/Components/Forms/SelectBox.vue";

export default {
    components: {
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        SelectBox,
    },
    props: {
        order: Object,
    },

    data() {
        return {
            customers: this.$page.props.customers,
            delivery_statuses: this.$page.props.delivery_statuses,
            payment_statuses: this.$page.props.payment_statuses,
            orderCustomer: this.$page.props.customers.find(
                (customer) => customer.id == this.order.customer_id
            ),
            deliveryStatus: this.$page.props.delivery_statuses.find(
                (status) => status.id == this.order.delivery_status_id
            ),
            paymentStatus: this.$page.props.payment_statuses.find(
                (status) => status.id == this.order.payment_status_id
            ),
            form: this.$inertia.form({
                _method: "PATCH",
                date: this.order.date,
                customer_id: this.order.customer_id,
                team_member_id: this.order.team_member_id,
                delivery_status_id: this.order.delivery_status_id,
                payment_status_id: this.order.payment_status_id,
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
        deliveryStatus() {
            if (this.deliveryStatus) {
                this.form.delivery_status_id = this.deliveryStatus.id;
            } else {
                this.form.delivery_status_id = null;
            }
        },
        paymentStatus() {
            if (this.paymentStatus) {
                this.form.payment_status_id = this.paymentStatus.id;
            } else {
                this.form.payment_status_id = null;
            }
        },
    },

    methods: {
        updateOrder() {
            this.form.patch(route("orders.update", this.order), {
                errorBag: "updateOrder",
                preserveScroll: true,
            });
        },
    },
};
</script>
