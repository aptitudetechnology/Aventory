<template>
  <div class="grid gap-4 grid-cols-8 md:grid-cols-11 py-2">
    <div></div>
    <div title="Product Name" class="truncate col-span-4">
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
      <jet-check-box
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
import EditOrderItem from "./EditOrderItem.vue";
import JetCheckBox from "@/Jetstream/Checkbox.vue";
export default {
  props: {
    item: Object,
  },
  data() {
    return {
      form: this.$inertia.form(this.item),
    };
  },
  components: {
    JetCheckBox,
    EditOrderItem,
  },
  methods: {
    itemReceived() {
      this.form.patch(route("order-item.update", this.item));
    },
  },
};
</script>