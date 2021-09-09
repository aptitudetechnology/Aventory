<template>
  <jet-form-section @submitted="updateOrder">
    <template #title>Update Order</template>

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
              :selectedItem="orderVendor"
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
        :class="{ 'opacity-25': form.processing || !form.isDirty }"
        :disabled="form.processing || !form.isDirty"
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
  props: {
    order: Object,
  },

  data() {
    return {
      vendors: this.$page.props.vendors,
      orderVendor: this.$page.props.vendors.find(
        (vendor) => vendor.id == this.order.vendor_id
      ),
      form: this.$inertia.form({
        _method: "PATCH",
        date: this.order.date,
        vendor_id: this.order.vendor_id,
        order_number: this.order.order_number,
        user_id: this.order.user_id,
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
    updateOrder() {
      this.form.patch(route("orders.update", this.order), {
        errorBag: "updateOrder",
        preserveScroll: true,
      });
    },
  },
};
</script>
