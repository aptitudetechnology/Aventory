<template>
    <jet-form-section @submitted="createOrder">
        <template #title>Create Order</template>

        <template #description> Create a new customer order. </template>

        <template #form>
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
                    <div
                        class="
                            col-span-1
                            lg:col-span-3
                            grid
                            gap-4
                            lg:grid-cols-2
                        "
                    >
                        <div>
                            <modal
                                :show="creatingCustomer"
                                @close="creatingCustomer = false"
                            >
                                <create-customer-form />
                            </modal>
                            <search-select-box
                                labelValue="Customer"
                                :items="customers"
                                @update="updateCustomer"
                                @add="addCustomer"
                            />
                            <jet-input-error
                                :message="order.errors.customer_id"
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
                                :message="order.errors.contact_id"
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
                                :message="order.errors.team_member_id"
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
                            justify-items-end
                        "
                    >
                        <div>
                            <jet-label for="date" value="Order Date" />
                            <jet-input
                                id="date"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="order.date"
                                required
                            />
                            <jet-input-error
                                :message="order.errors.date"
                                class="mt-2"
                            />
                        </div>
                    </div>
                    <div class="sm:col-span-2 lg:col-span-5 sm:flex">
                        <div class="sm:w-1/4 mb-6 sm:mb-0">
                            <jet-label class="flex items-center text-lg px-2">
                                <jet-checkbox
                                    class="mr-2 mb-1"
                                    :checked="order.is_taxable"
                                    v-model="order.is_taxable"
                                />Taxable</jet-label
                            >
                        </div>
                        <div class="sm:w-3/4 sm:ml-4">
                            <jet-label for="notes" value="Order Notes" />
                            <text-area-input
                                id="notes"
                                type="notes"
                                class="mt-1 block w-full"
                                v-model="order.notes"
                            />
                            <jet-input-error
                                :message="order.errors.notes"
                                class="mt-2"
                            />
                        </div>
                    </div>
                </div>
                <div>
                    <jet-section-title :showTitleBorder="false">
                        <template #title>Products and Services</template>
                    </jet-section-title>
                    <div class="">
                        <div v-for="item in order.items" :key="item"></div>
                        <create-order-item :order="order" />
                    </div>
                </div>
            </div>
        </template>

        <template #actions>
            <jet-button
                type="submit"
                :class="{ 'opacity-25': order.processing }"
                :disabled="order.processing"
                >New Order</jet-button
            >
        </template>
    </jet-form-section>
</template>

<script>
import JetSectionTitle from "@/Jetstream/SectionTitle.vue";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import TextAreaInput from "@Components/Forms/TextAreaInput";
import SelectBox from "@/Components/Forms/SelectBox.vue";
import SearchSelectBox from "@/Components/Forms/SearchSelectBox.vue";
import CreateOrderItem from "./CreateOrderItem.vue";
import Modal from "@/Components/Modal.vue";
import CreateCustomerForm from "@/Pages/Customers/CreateCustomerForm.vue";
export default {
    components: {
        JetSectionTitle,
        JetButton,
        JetFormSection,
        JetInput,
        JetCheckbox,
        JetInputError,
        JetLabel,
        SelectBox,
        SearchSelectBox,
        TextAreaInput,
        CreateOrderItem,
        Modal,
        CreateCustomerForm,
    },

    data() {
        return {
            creatingCustomer: false,
            customers: this.$page.props.customers,
            customerContacts: [],
            teamMembers: this.$page.props.teamMembers,
            orderCustomer: null,
            contact: null,
            teamMember: this.$page.props.teamMembers.find(
                (member) => member.id === this.$page.props.user.id
            ),
            order: this.$inertia.form({
                _method: "POST",
                date: new Date().toISOString().slice(0, -14),
                notes: "",
                items: [],
                customer_id: null,
                contact_id: null,
                team_member_id: this.$page.props.user.id,
                is_taxable: true,
            }),
        };
    },
    watch: {
        orderCustomer(orderCustomer) {
            if (orderCustomer) {
                this.order.customer_id = orderCustomer.id;
                this.customerContacts = orderCustomer.contacts;
                this.order.is_taxable = orderCustomer.is_taxable;
            } else {
                this.order.customer_id = null;
                this.customer_contact_id = null;
            }
        },
        contact(value) {
            if (value) {
                this.order.contact_id = value.id;
            } else {
                this.order.contact_id = null;
            }
        },
        teamMember(value) {
            if (value) {
                this.order.team_member_id = value.id;
            } else {
                this.order.team_member_id = null;
            }
        },
    },

    methods: {
        createOrder() {
            this.order.post(route("orders.store"), {
                errorBag: "createOrder",
                preserveScroll: true,
            });
        },
        updateCustomer(customerId) {
            this.orderCustomer = this.customers.find(
                (customer) => customer.id === customerId
            );
        },
        addCustomer(customerName) {
            this.creatingCustomer = true;
        },
    },
};
</script>
