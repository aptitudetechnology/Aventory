<template>
  <orders-layout>
    <div>
      <div class="space-y-6">
        <update-order-form :order="order" />
        <delete-order-form :order="order" />
      </div>
    </div>
  </orders-layout>
</template>

<script>
import OrdersLayout from "./OrdersLayout.vue";
import UpdateOrderForm from "@/Pages/Orders/UpdateOrderForm";
import ButtonLink from "@/Components/ButtonLink";
import DeleteOrderForm from "./DeleteOrderForm.vue";
export default {
  components: {
    OrdersLayout,
    UpdateOrderForm,
    ButtonLink,
    DeleteOrderForm,
  },
  props: {
    order: Object,
  },
};
</script>
