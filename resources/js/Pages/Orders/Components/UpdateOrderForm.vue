<template>
    <details-section>
        <template #title
            ><span class="uppercase">{{ order.customer.name }}:</span> Order #{{
                order.id
            }}
            <span
                type="submit"
                @click="updateOrder"
                :class="[
                    'ml-4 fixed bottom-5 right-10 z-50 md:static rounded bg-white p-3 text-base',
                ]"
                v-show="updatedOrder.processing"
                :disabled="updatedOrder.processing || !updatedOrder.isDirty"
            >
                Saving Changes...
            </span></template
        >
        <template #aside
            ><h3 class="text-lg">
                Grand Total: {{ formatMoney(order.grand_total) }}
            </h3>
        </template>

        <div class="col-span-6 grid gap-6">
            <div
                class="
                    grid
                    sm:grid-cols-2
                    lg:grid-cols-5
                    gap-4
                    xl:gap-x-20
                    lg:gap-y-8
                "
            >
                <div class="col-span-1 lg:col-span-3 grid gap-4 lg:grid-cols-2">
                    <div>
                        <modal
                            :show="creatingCustomer"
                            @close="creatingCustomer = false"
                        >
                            <create-customer-form
                                @created="createdCustomer"
                                :redirect="false"
                                :customerName="customerName"
                            />
                        </modal>
                        <search-select-box
                            labelValue="Customer"
                            :items="customers"
                            :selectedItem="orderCustomer"
                            @update="updateCustomer"
                            @add="addCustomer"
                        />
                        <jet-input-error
                            :message="updatedOrder.errors.customer_id"
                            class="mt-2"
                        />
                    </div>
                    <div v-if="orderCustomer && customerContacts.length">
                        <select-box
                            labelValue="Customer Contact"
                            :items="customerContacts"
                            v-model="contact"
                            :selectedItem="contact"
                        />
                        <jet-input-error
                            :message="updatedOrder.errors.contact_id"
                            class="mt-2"
                        />
                    </div>
                    <div class="">
                        <select-box
                            labelValue="Sales Person"
                            :items="teamMembers"
                            :selectedItem="teamMember"
                            v-model="teamMember"
                        />
                        <jet-input-error
                            :message="updatedOrder.errors.team_member_id"
                            class="mt-2"
                        />
                    </div>
                </div>
                <div
                    class="
                        col-span-1
                        lg:col-span-2
                        grid
                        gap-4
                        lg:justify-items-end
                    "
                >
                    <div>
                        <jet-label for="date" value="Order Date" />
                        <jet-input
                            id="date"
                            type="date"
                            class="mt-1 block w-full"
                            @blur="updateOrder"
                            v-model="updatedOrder.date"
                            required
                        />
                        <jet-input-error
                            :message="updatedOrder.errors.date"
                            class="mt-2"
                        />
                    </div>
                </div>
                <div class="sm:col-span-2 lg:col-span-5">
                    <div class="">
                        <jet-label for="notes" value="Order Notes" />
                        <text-area-input
                            id="notes"
                            type="notes"
                            @blur="updateOrder"
                            class="mt-1 block w-full"
                            v-model="updatedOrder.notes"
                        />
                        <jet-input-error
                            :message="updatedOrder.errors.notes"
                            class="mt-2"
                        />
                    </div>
                </div>
            </div>
            <order-items :order="order"></order-items>
            <totals :order="order"></totals>
        </div>
    </details-section>
</template>

<script>
import JetSectionTitle from "@/Jetstream/SectionTitle.vue";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import TextAreaInput from "@Components/Forms/TextAreaInput";
import SelectBox from "@/Components/Forms/SelectBox.vue";
import SearchSelectBox from "@/Components/Forms/SearchSelectBox.vue";
import Modal from "@/Jetstream/Modal.vue";
import CreateCustomerForm from "@/Pages/Customers/CreateCustomerForm.vue";
import OrderItems from "@/Pages/Orders/Components/OrderItems.vue";
import DetailsSection from "@Components/DetailsSection.vue";
import Totals from "@/Pages/Orders/Components/Totals.vue";
import { Inertia } from "@inertiajs/inertia";
export default {
    components: {
        JetSectionTitle,
        JetButton,
        JetInput,
        JetCheckbox,
        JetInputError,
        JetLabel,
        SelectBox,
        SearchSelectBox,
        TextAreaInput,
        Modal,
        CreateCustomerForm,
        OrderItems,
        DetailsSection,
        Totals,
    },
    props: {
        order: {
            type: Object,
            required: true,
        },
        customers: {
            type: Array,
            required: true,
        },
        priceLevels: {
            type: Array,
            required: true,
        },
    },

    data() {
        return {
            creatingCustomer: false,
            customerName: "",
            customerContacts: [],
            teamMembers: this.$page.props.teamMembers,
            orderCustomer: this.customers.find(
                (customer) => customer.id === this.order.customer_id
            ),
            contact: this.order.contact,
            teamMember: this.$page.props.teamMembers.find(
                (member) => member.id === this.order.team_member_id
            ),
            updatedOrder: this.$inertia.form(this.order),
        };
    },
    watch: {
        orderCustomer(orderCustomer) {
            if (orderCustomer) {
                this.updatedOrder.customer_id = orderCustomer.id;
                this.customerContacts = orderCustomer.contacts
                    ? orderCustomer.contacts
                    : [];
                this.updatedOrder.is_taxable = orderCustomer.is_taxable;
            } else {
                this.updatedOrder.customer_id = null;
                this.customer_contact_id = null;
            }
            this.updateOrder();
        },
        contact(value) {
            if (value) {
                this.updatedOrder.contact_id = value.id;
            } else {
                this.updatedOrder.contact_id = null;
            }
            this.updateOrder();
        },
        teamMember(value) {
            if (value) {
                this.updatedOrder.team_member_id = value.id;
            } else {
                this.updatedOrder.team_member_id = null;
            }
            this.updateOrder();
        },
    },
    methods: {
        updateOrder() {
            this.$nextTick(() => {
                if (this.updatedOrder.isDirty) {
                    this.updatedOrder.patch(
                        route("orders.update", this.order.id),
                        {
                            errorBag: "updateOrder",
                            preserveScroll: true,
                        }
                    );
                }
            });
        },
        updateCustomer(customerId) {
            this.orderCustomer = this.customers.find(
                (customer) => customer.id == customerId
            );
        },
        addCustomer(customerName) {
            this.customerName = customerName;
            this.creatingCustomer = true;
        },
        createdCustomer(newCustomer) {
            Inertia.reload();
            this.customers.push(newCustomer);
            this.updateCustomer(newCustomer.id);
            this.creatingCustomer = false;
        },
    },
};
</script>
