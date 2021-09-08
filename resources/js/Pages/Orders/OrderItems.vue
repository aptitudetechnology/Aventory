<template>
  <jet-action-section>
    <template #title>Order Items</template>
    <template #aside> <create-order-item :order="order" /> </template>
    <template #content>
      <div
        class="
          grid
          gap-4
          grid-cols-9
          md:grid-cols-11
          py-3
          text-left text-xs
          font-medium
          text-gray-500
          uppercase
          tracking-wider
        "
      >
        <div></div>
        <div class="col-span-4 truncate">Product Name</div>
        <div class="truncate">Size</div>

        <div class="truncate">Confirmed</div>
        <div class="truncate hidden md:block">Price</div>
        <div class="truncate">Received</div>
        <div class="truncate hidden md:block">Printed</div>
        <div></div>
      </div>
      <div class="divide-gray-50 divide-y">
        <order-line-item
          v-for="item in orderItems"
          :key="item.id"
          :item="item"
        />
      </div>
    </template>
  </jet-action-section>
</template>

<script>
import JetActionSection from "@/Jetstream/ActionSection.vue";
import CreateOrderItem from "./CreateOrderItem.vue";
import OrderLineItem from "./OrderLineItem.vue";
export default {
  props: { order: Object, orderItems: Array },
  components: {
    JetActionSection,
    CreateOrderItem,
    OrderLineItem,
  },
};
</script>