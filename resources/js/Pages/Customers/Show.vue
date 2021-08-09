<template>
  <customers-layout>
    <update-customer-form :customer="customer" />
  </customers-layout>
</template>

<script>
import CustomersLayout from "./CustomersLayout.vue";
import UpdateCustomerForm from "@/Pages/Customers/UpdateCustomerForm";
import ButtonLink from "@/Components/ButtonLink";
export default {
  components: {
    CustomersLayout,
    UpdateCustomerForm,
    ButtonLink,
  },
  props: {
    customer: Object,
  },
};
</script>
