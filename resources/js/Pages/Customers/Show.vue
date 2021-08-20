<template>
  <customers-layout>
    <div>
      <div class="xl:flex gap-x-6">
        <div class="xl:w-3/4 mb-6">
          <update-customer-form :customer="customer" />
        </div>
        <div class="xl:w-1/4">
          <contact-aside :customer="customer" />
        </div>
      </div>
      <delete-customer-form :customer="customer" />
    </div>
  </customers-layout>
</template>

<script>
import CustomersLayout from "./CustomersLayout.vue";
import UpdateCustomerForm from "@/Pages/Customers/UpdateCustomerForm";
import ButtonLink from "@/Components/ButtonLink";
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
