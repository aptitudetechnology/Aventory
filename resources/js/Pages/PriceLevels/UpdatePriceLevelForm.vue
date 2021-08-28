<template>
  <jet-form-section @submitted="updatePriceLevel">
    <template #title>{{ priceLevel.name }}</template>

    <template #description>
      Update this price level. Customers in this price level will automatically
      have this price adjustment applied to their orders.
    </template>

    <template #form>
      <div class="col-span-6">
        <div class="grid gap-4">
          <div class="col-span-3">
            <jet-label for="name" value="Price Level Name" />
            <jet-input
              id="name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.name"
              required
              autocomplete="off"
            />
            <jet-input-error :message="form.errors.name" class="mt-2" />
          </div>
          <div class="col-span-3">
            <jet-label for="description" value="Price level description" />
            <text-area-input
              id="description"
              class="mt-1 block w-full"
              v-model="form.description"
            />
            <jet-input-error :message="form.errors.description" class="mt-2" />
          </div>
          <div class="col-span-3 sm:col-span-1">
            <jet-label
              for="percentage_more"
              value="Percentage more than base price"
            />
            <div class="percentage_more">
              <jet-input
                id="percentage_more"
                type="number"
                min="0"
                placeholder="0"
                class="mt-1 block w-full"
                v-model="form.percentage_more"
              />
            </div>
            <jet-input-error
              :message="form.errors.percentage_more"
              class="mt-2"
            />
          </div>
        </div>
      </div>
    </template>

    <template #actions>
      <jet-button
        type="submit"
        :class="{ 'opacity-25': form.processing || !form.isDirty }"
        :disabled="form.processing || !form.isDirty"
        >Save Price Level</jet-button
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
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

import TextAreaInput from "../../Components/TextAreaInput.vue";

export default {
  components: {
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    TextAreaInput,
  },
  props: { priceLevel: Object },

  data() {
    return {
      form: this.$inertia.form({
        _method: "PATCH",
        name: this.priceLevel.name,
        description: this.priceLevel.description,
        percentage_more: this.priceLevel.percentage_more,
      }),
    };
  },
  methods: {
    updatePriceLevel() {
      this.form.patch(
        route("customer-price-levels.update", this.priceLevel.id),
        {
          errorBag: "updatePriceLevel",
          preserveScroll: true,
        }
      );
    },
  },
};
</script>
