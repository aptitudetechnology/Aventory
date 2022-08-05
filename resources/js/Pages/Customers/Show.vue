<template>
    <customers-layout>
        <div>
            <div class="lg:grid lg:grid-cols-8 gap-4">
                <div class="lg:col-span-5 mb-6">
                    <update-customer-form :customer="customer" />
                </div>
                <div class="lg:col-span-3">
                    <contact-aside
                        contactable-type="customers"
                        :contactable-id="customer.id"
                        :contacts="customer.contacts"
                    />
                </div>
            </div>
            <delete-customer-form :customer="customer" />
        </div>
    </customers-layout>
</template>

<script>
import CustomersLayout from "./CustomersLayout.vue";
import UpdateCustomerForm from "@/Pages/Customers/UpdateCustomerForm.vue";
import ButtonLink from "@/Components/Links/ButtonLink.vue";
import DeleteCustomerForm from "./DeleteCustomerForm.vue";
import ContactAside from "../Contacts/ContactAside.vue";
export default {
    components: {
        CustomersLayout,
        UpdateCustomerForm,
        ButtonLink,
        DeleteCustomerForm,
        ContactAside,
    },
    props: {
        customer: Object,
    },
};
</script>
