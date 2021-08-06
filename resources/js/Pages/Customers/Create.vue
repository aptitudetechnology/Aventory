<template>
  <customers-layout>
    <template #header>
      <div class="md:flex md:items-center md:justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Create a new Customer
        </h2>
      </div>
    </template>
    <create-customer-form />
  </customers-layout>
</template>

<script>
import CreateCustomerForm from "@/Pages/Customers/CreateCustomerForm";
import CustomersLayout from "./CustomersLayout.vue";
export default {
  components: {
    CreateCustomerForm,
    CustomersLayout,
  },
};
</script>
