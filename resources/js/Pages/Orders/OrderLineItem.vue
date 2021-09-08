<template>
  <div class="grid gap-4 grid-cols-2 md:grid-cols-11 py-2">
    <div>
      <jet-label class="sr-only" :for="'item-selected' + form.id"
        >Select</jet-label
      >
      <jet-check-box
        :id="'item-selected' + form.id"
        @change="$emit('selected')"
        :value="form.id"
        v-model="selected"
        :checked="selected"
      ></jet-check-box>
    </div>
    <div title="Product Name" class="truncate col-span-2 md:col-span-4">
      {{ form.product.name }}
    </div>
    <div class="px-1" title="Product Size">{{ form.size.name }}</div>
    <div class="px-1" title="Quantity Confirmed">
      {{ form.quantity_confirmed }}
    </div>

    <div class="px-1 hidden md:block" title="Unit Price">
      ${{ form.unit_price }}
    </div>
    <div class="px-1">
      <jet-label class="sr-only" :for="'item-recieved' + form.id"
        >Item Received</jet-label
      >
      <jet-check-box
        :id="'item-recieved' + form.id"
        @change="itemReceived"
        v-model="form.received"
        :checked="form.received"
      ></jet-check-box>
    </div>
    <div class="px-1 hidden md:block">
      <jet-check-box :disabled="true" :checked="form.printed"></jet-check-box>
    </div>
    <edit-order-item title="Edit" :orderItem="item"></edit-order-item>
  </div>
</template>

<script>
import JetCheckBox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";

import EditOrderItem from "./EditOrderItem.vue";
export default {
  props: {
    item: Object,
    itemSelected: Boolean,
  },
  data() {
    return {
      selected: this.itemSelected,
      form: this.$inertia.form(this.item),
    };
  },
  components: {
    JetCheckBox,
    JetLabel,

    EditOrderItem,
  },
  watch: {
    itemSelected() {
      this.selected = this.itemSelected;
    },
  },
  methods: {
    itemReceived() {
      this.form.patch(route("order-item.update", this.item));
    },
  },
};
</script>