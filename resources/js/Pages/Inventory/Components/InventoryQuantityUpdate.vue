<template>
  <div
    v-if="inventory.type == 'group'"
    class="py-4 w-full flex items-center space-x-2"
  >
    <JetLabel for="quantity" class="text-lg w-full">Quantity in Group</JetLabel>
    <jet-input
      id="quantity"
      type="number"
      @change="updateInventory"
      v-model="form.quantity"
      class="block w-full"
    />
  </div>
</template>
<script>
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
export default {
  components: { JetInput, JetLabel },
  props: {
    inventory: Object,
  },
  data() {
    return {
      form: this.$inertia.form(this.inventory),
    };
  },
  methods: {
    updateInventory() {
      this.form.patch(route("inventory.update", this.inventory));
    },
  },
};
</script>