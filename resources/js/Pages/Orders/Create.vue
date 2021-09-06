<template>
  <orders-layout>
    <create-order-form />
  </orders-layout>
</template>

<script>
import CreateOrderForm from "./CreateOrderForm";
import OrdersLayout from "./OrdersLayout.vue";
export default {
  components: {
    CreateOrderForm,
    OrdersLayout,
  },
};
</script>
