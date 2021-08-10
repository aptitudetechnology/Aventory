<template>
  <customers-layout>
    <update-customer-form :customer="customer" />
    <delete-customer-form
      v-if="!customer.deleted_at"
      :customer="customer"
      class="mt-6"
    />
  </customers-layout>
</template>

<script>
import CustomersLayout from "./CustomersLayout.vue";
import UpdateCustomerForm from "@/Pages/Customers/UpdateCustomerForm";
import ButtonLink from "@/Components/ButtonLink";
import DeleteCustomerForm from "./DeleteCustomerForm.vue";
export default {
  components: {
    CustomersLayout,
    UpdateCustomerForm,
    ButtonLink,
    DeleteCustomerForm,
  },
  props: {
    customer: Object,
  },
};
</script>
