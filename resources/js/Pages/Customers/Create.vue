<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          New Customer
        </h2>
        <button-link :href="route('customers.index')"
          >Back to Customers</button-link
        >
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <create-customer-form />
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import CreateCustomerForm from "@/Pages/Customers/CreateCustomerForm";
import ButtonLink from "@/Components/ButtonLink";
export default {
  components: {
    AppLayout,
    CreateCustomerForm,
    ButtonLink,
  },
};
</script>
