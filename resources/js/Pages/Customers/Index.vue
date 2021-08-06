<template>
  <customers-layout>
    <template #header>
      <div class="md:flex md:items-center md:justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Customers
        </h2>
        <button-link :href="route('customers.create')"
          >New Customer</button-link
        >
      </div>
    </template>
  </customers-layout>
</template>

<script>
import CustomersLayout from "./CustomersLayout.vue";
import EmptyState from "@/Components/EmptyState";
import ButtonLink from "@/Components/ButtonLink";
export default {
  components: {
    CustomersLayout,
    ButtonLink,
  },
};
</script>
