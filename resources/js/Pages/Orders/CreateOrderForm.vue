<template>
  <jet-form-section @submitted="createOrder">
    <template #title>Create an Order</template>

    <template #description>
      Create a new order to bring into inventory.
    </template>

    <template #form>
      <div class="col-span-6">
        <div class="grid gap-4 sm:grid-cols-3">
          <div class="col-span-1">
            <jet-label for="date" value="Order Date" />
            <jet-input
              id="date"
              type="date"
              class="mt-1 block w-full"
              v-model="form.date"
              required
            />
            <jet-input-error :message="form.errors.date" class="mt-2" />
          </div>
          <div class="col-span-1">
            <select-box
              labelValue="Vendor"
              :items="vendors"
              v-model="orderVendor"
            />
            <jet-input-error :message="form.errors.vendor_id" class="mt-2" />
          </div>
          <div class="col-span-1">
            <jet-label for="order_number" value="Order Number" />
            <jet-input
              id="order_number"
              type="text"
              class="mt-1 block w-full"
              v-model="form.order_number"
            />
            <jet-input-error :message="form.errors.order_number" class="mt-2" />
          </div>
        </div>
      </div>
    </template>

    <template #actions>
      <jet-button
        type="submit"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        >Save Order</jet-button
      >
    </template>
  </jet-form-section>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

import SelectBox from "@Components/SelectBox.vue";

export default {
  components: {
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    SelectBox,
  },

  data() {
    return {
      vendors: this.$page.props.vendors,
      orderVendor: null,
      form: this.$inertia.form({
        _method: "POST",
        date: "",
        vendor_id: null,
        order_number: null,
        user_id: this.$page.props.user.id,
      }),
    };
  },
  watch: {
    orderVendor() {
      if (this.orderVendor) {
        this.form.vendor_id = this.orderVendor.id;
      } else {
        this.form.vendor_id = null;
      }
    },
  },

  methods: {
    createOrder() {
      this.form.post(route("orders.store"), {
        errorBag: "createOrder",
        preserveScroll: true,
      });
    },
  },
};
</script>
