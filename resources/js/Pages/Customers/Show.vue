<template>
  <customers-layout>
    <update-customer-form :customer="customer" />
  </customers-layout>
</template>

<script>
import CustomersLayout from "./CustomersLayout.vue";
import UpdateCustomerForm from "@/Pages/Customers/UpdateCustomerForm";
export default {
  components: {
    CustomersLayout,
    UpdateCustomerForm,
  },
  props: {
    customer: Object,
  },
};
</script>
