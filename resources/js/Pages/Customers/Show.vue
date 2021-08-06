<template>
  <customers-layout>
    <template #header>
      <div class="md:flex md:items-center md:justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ customer.name }}
        </h2>
        <button-link :href="route('customers.create')"
          >New Customer</button-link
        >
      </div>
    </template>
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
