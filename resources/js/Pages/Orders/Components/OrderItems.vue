<template>
  <jet-action-section>
    <template #title>Order Items</template>
    <template #aside> <create-order-item :order="order" /> </template>
    <template #content>
      <div class="flex pb-4" v-if="selected.length">
        <AddOrderItemsToInventory
          v-if="itemsNotInInventory"
          :selectedItems="selected"
        />
      </div>
      <div>
        <div
          class="
            py-3
            text-left text-xs
            font-medium
            text-gray-500
            uppercase
            tracking-wider
            grid
            gap-4
            grid-cols-5
            md:grid-cols-10
            items-center
            border-b border-gray-50
          "
        >
          <div class="col-span-2 md:col-span-4 flex items-center">
            <jet-label class="sr-only" for="select-all">Select all</jet-label
            ><jet-checkbox
              id="select-all"
              :checked="allSelected"
              v-model="allSelected"
              @change="toggleAllSelected"
            />
            <div class="ml-6">Name</div>
          </div>

          <div class="truncate">Size</div>

          <div class="truncate">Confirmed</div>
          <div class="hidden md:block truncate">Price</div>
          <div class="hidden md:block truncate">Received</div>
          <div class="hidden md:block truncate">Printed</div>
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
import AddOrderItemsToInventory from "./AddOrderItemsToInventory.vue";
export default {
  props: { order: Object, orderItems: Array },

  components: {
    JetActionSection,
    JetCheckbox,
    JetLabel,
    JetButton,

    CreateOrderItem,
    OrderLineItem,
    AddOrderItemsToInventory,
  },

  data() {
    return {
      allSelected: false,
      selected: [],
    };
  },

  computed: {
    itemsNotInInventory() {
      return this.orderItems.map((item) => item.in_inventory).includes(false);
    },
  },
  watch: {
    selected() {
      //watches selected to uncheck the select all checkbox if selected is empty
      let selectedLength = this.selected.length;

      if (selectedLength === 0) {
        this.allSelected = false;
      }
    },
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
