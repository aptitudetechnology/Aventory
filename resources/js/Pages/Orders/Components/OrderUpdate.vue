<template>
    <details-section>
        <template #title
            ><span class="uppercase"
                >{{ order.customer.name }}: {{ order.type }} #{{
                    order.id
                }}</span
            >
            <span
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
            <div class="grid lg:grid-cols-2 gap-x-4 gap-y-2 2xl:gap-x-20">
                <div class="col-span-1 grid xl:grid-cols-2 gap-x-4 gap-y-2">
                    <div>
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
                    </div>
                    <div v-show="orderCustomer && customerContacts.length">
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
                    <div>
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
                <div class="col-span-1 grid grid-cols-2 gap-4">
                    <div
                        class="form-control"
                        :class="
                            order.is_quote ? '' : 'col-span-2 justify-self-end'
                        "
                    >
                        <jet-label for="date" value="Order Date" />
                        <jet-input
                            id="date"
                            type="date"
                            class="block w-full"
                            v-model="updatedOrder.date"
                            required
                        />
                        <jet-input-error
                            :message="updatedOrder.errors.date"
                            class="mt-2"
                        />
                    </div>
                    <div v-if="isQuote">
                        <jet-label for="quote_expires" value="Expire Date" />
                        <jet-input
                            id="quote_expires"
                            type="date"
                            class="block w-full"
                            v-model="updatedOrder.quote_expires"
                            required
                        />
                        <jet-input-error
                            :message="updatedOrder.errors.quote_expires"
                            class="mt-2"
                        />
                    </div>
                    <QuoteHoldInventoryCheckmark
                        v-if="isQuote"
                        v-model="updatedOrder.hold_inventory"
                        @change="updateOrder"
                        :errorMessage="updatedOrder.errors.hold_inventory"
                    />
                </div>
                <div class="lg:col-span-2">
                    <div class="">
                        <jet-label for="notes" value="Order Notes" />
                        <text-area-input
                            id="notes"
                            type="notes"
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
            <discounts :order="order"></discounts>
            <totals :order="order"></totals>
        </div>
    </details-section>
</template>

<script>
import TextAreaInput from "@/Components/Forms/TextAreaInput";
import SearchSelectBox from "@/Components/Forms/SearchSelectBox.vue";
import Modal from "@/Jetstream/Modal.vue";
import CreateCustomerForm from "@/Pages/Customers/CreateCustomerForm.vue";
import OrderItems from "@/Pages/Orders/Components/Items.vue";
import Discounts from "@/Pages/Orders/Components/Discounts.vue";
import Totals from "@/Pages/Orders/Components/Totals.vue";
import QuoteHoldInventoryCheckmark from "@/Pages/Orders/Components/QuoteHoldInventoryCheckmark.vue";
import { Inertia } from "@inertiajs/inertia";

// import debounce from "lodash/debounce";
import _debounce from "lodash/debounce";

export default {
    components: {
        SearchSelectBox,
        TextAreaInput,
        Modal,
        CreateCustomerForm,
        OrderItems,
        Discounts,
        Totals,
        QuoteHoldInventoryCheckmark,
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
            updatedOrder: this.$inertia.form({
                customer_id: this.order.customer_id,
                contact_id: this.order.contact_id,
                team_member_id: this.order.team_member_id,
                date: this.order.date,
                quote_expires: this.order.quote_expires,
                hold_inventory: this.order.hold_inventory,
                notes: this.order.notes,
            }),
        };
    },
    computed: {
        isQuote() {
            return this.order.is_quote;
        },
    },
    watch: {
        "updatedOrder.customer_id": _debounce(function () {
            this.updateOrder();
        }, 500),
        "updatedOrder.team_member_id": _debounce(function () {
            this.updateOrder();
        }, 500),
        "updatedOrder.date": _debounce(function () {
            this.updateOrder();
        }, 1000),
        "updatedOrder.quote_expires": _debounce(function () {
            this.updateOrder();
        }, 1000),
        "updatedOrder.notes": _debounce(function () {
            this.updateOrder();
        }, 1000),
        orderCustomer(orderCustomer) {
            if (orderCustomer) {
                this.updatedOrder.customer_id = orderCustomer.id;
                this.customerContacts = orderCustomer.contacts
                    ? orderCustomer.contacts
                    : [];
                this.contact = null;
                this.updatedOrder.is_taxable = orderCustomer.is_taxable;
            } else {
                this.updatedOrder.customer_id = null;
                this.contact = null;
            }
        },
        contact(value) {
            if (value) {
                this.updatedOrder.contact_id = value.id;
            } else {
                this.updatedOrder.contact_id = null;
            }
        },
        teamMember(value) {
            if (value) {
                this.updatedOrder.team_member_id = value.id;
            } else {
                this.updatedOrder.team_member_id = null;
            }
        },
    },
    methods: {
        sendQuoteChanges() {
            this.updatedOrder.patch(route("quotes.update", this.order.id), {
                errorBag: "updateOrder",
                preserveScroll: true,
            });
        },
        sendOrderChanges() {
            this.updatedOrder.patch(route("orders.update", this.order.id), {
                errorBag: "updateOrder",
                preserveScroll: true,
            });
        },
        updateOrder() {
            this.$nextTick(() => {
                if (
                    this.updatedOrder.isDirty &&
                    !this.updatedOrder.processing
                ) {
                    if (this.order.is_quote) {
                        this.sendQuoteChanges();
                    } else {
                        this.sendOrderChanges();
                    }
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
