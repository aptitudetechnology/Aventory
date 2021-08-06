<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ customer.name }}
        </h2>
        <button-link :href="route('customers.index')"
          >Back to Customers</button-link
        >
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <update-customer-form :customer="customer" />
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import UpdateCustomerForm from "@/Pages/Customers/UpdateCustomerForm";
import ButtonLink from "@/Components/ButtonLink";
export default {
  components: {
    AppLayout,
    UpdateCustomerForm,
    ButtonLink,
  },
  props: {
    customer: Object,
  },
};
</script>
