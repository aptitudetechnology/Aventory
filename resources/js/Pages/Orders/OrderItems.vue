<template>
  <jet-action-section>
    <template #title>Order Items</template>
    <template #aside> <create-order-item :order="order" /> </template>
    <template #content>
      <div class="flex pb-4" v-if="selected.length">
        <jet-button>Print Selected</jet-button>
      </div>
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
        <div>
          <jet-label class="sr-only" for="select-all">Select all</jet-label
          ><jet-checkbox
            id="select-all"
            v-model="allSelected"
            @change="toggleAllSelected"
          />
        </div>
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
          @selected="toggleSelected(item)"
          v-for="item in orderItems"
          :key="item.id"
          :item="item"
          :itemSelected="isItemSelected(item)"
        />
      </div>
    </template>
  </jet-action-section>
</template>

<script>
import JetActionSection from "@/Jetstream/ActionSection.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetButton from "@/Jetstream/Button.vue";

import CreateOrderItem from "./CreateOrderItem.vue";
import OrderLineItem from "./OrderLineItem.vue";

export default {
  props: { order: Object, orderItems: Array },

  data() {
    return {
      allSelected: false,
      selected: [],
    };
  },

  components: {
    JetActionSection,
    JetCheckbox,
    JetLabel,
    JetButton,

    CreateOrderItem,
    OrderLineItem,
  },

  methods: {
    toggleSelected(item) {
      if (this.selected.includes(item.id)) {
        this.selected = this.selected.filter((id) => id != item.id);
      } else {
        this.selected.push(item.id);
      }
    },

    isItemSelected(item) {
      return this.selected.includes(item.id);
    },

    toggleAllSelected() {
      if (this.allSelected) {
        this.selected = this.orderItems.map((item) => item.id);
      } else {
        this.selected = [];
      }
    },
  },
};
</script>