<template>
  <jet-form-section @submitted="updateBlock">
    <template #title>{{ block.name }}</template>
    <template #aside
      ><button-link :href="route('blocks.show', block)"
        >View Blocks</button-link
      ></template
    >
    <template #form>
      <div class="grid col-span-6 gap-4">
        <div class="grid grid-cols-6 gap-2">
          <div class="col-span-4 sm:col-span-5">
            <jet-label for="name" value="Block Name" />
            <jet-input
              id="name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.name"
              required
              autocomplete="organization"
            />
            <jet-input-error :message="form.errors.name" class="mt-2" />
          </div>
          <div class="col-span-2 sm:col-span-1">
            <jet-label for="block_code" value="Code" />
            <jet-input
              id="block_code"
              type="text"
              class="mt-1 block w-full"
              v-model="form.block_code"
              required
              autocomplete="off"
            />
            <jet-input-error :message="form.errors.block_code" class="mt-2" />
          </div>
        </div>
        <div class="grid gap-4">
          <div class="col-span-3">
            <jet-label for="address" value="Street Address" />
            <jet-input
              id="address"
              type="text"
              class="mt-1 block w-full"
              v-model="form.address"
              autocomplete="address"
            />
            <jet-input-error :message="form.errors.address" class="mt-2" />
          </div>
          <div class="col-span-3 sm:col-span-1">
            <jet-label for="city" value="City" />
            <jet-input
              id="city"
              type="text"
              class="mt-1 block w-full"
              v-model="form.city"
              autocomplete="address-level2"
            />
            <jet-input-error :message="form.errors.city" class="mt-2" />
          </div>
          <div class="col-span-3 sm:col-span-1">
            <jet-label for="state" value="State" />
            <jet-input
              id="state"
              type="text"
              class="mt-1 block w-full"
              v-model="form.state"
              autocomplete="address-level1"
            />
            <jet-input-error :message="form.errors.state" class="mt-2" />
          </div>
          <div class="col-span-3 sm:col-span-1">
            <jet-label for="zip" value="Zip" />
            <jet-input
              id="zip"
              type="text"
              class="mt-1 block w-full"
              v-model="form.zip"
              autocomplete="postal-code"
            />
            <jet-input-error :message="form.errors.zip" class="mt-2" />
          </div>
        </div>
      </div>
    </template>

    <template #actions>
      <jet-button
        type="submit"
        :class="{ 'opacity-25': form.processing || !form.isDirty }"
        :disabled="form.processing || !form.isDirty"
        >Save Block</jet-button
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
import TextAreaInput from "@Components/TextAreaInput.vue";
import SelectBox from "@Components/SelectBox.vue";
import ButtonLink from "@Components/ButtonLink.vue";
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
    SelectBox,
    ButtonLink,
  },
  props: { block: Object },

  data() {
    return {
      form: this.$inertia.form({
        _method: "PATCH",
        name: this.block.name,
        block_code: this.block.block_code,
        address: this.block.address,
        city: this.block.city,
        state: this.block.state,
        zip: this.block.zip,
      }),
    };
  },

  methods: {
    updateBlock() {
      this.form.patch(route("blocks.update", this.block), {
        errorBag: "updateBlock",
        preserveScroll: true,
      });
    },
  },
};
</script>
