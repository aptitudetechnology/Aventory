<template>
  <jet-form-section @submitted="createLocation">
    <template #title>Create a Location</template>

    <template #description>
      Create a new nursery location where you sell or grow plants.
    </template>

    <template #form>
      <div class="grid col-span-6 gap-4">
        <div class="grid grid-cols-6 gap-2">
          <div class="col-span-4 sm:col-span-5">
            <jet-label for="name" value="Location Name" />
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
            <jet-label for="location_code" value="Code" />
            <jet-input
              id="location_code"
              type="text"
              class="mt-1 block w-full"
              v-model="form.location_code"
              required
              autocomplete="off"
            />
            <jet-input-error
              :message="form.errors.location_code"
              class="mt-2"
            />
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
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        >Save Location</jet-button
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

  data() {
    return {
      form: this.$inertia.form({
        _method: "POST",
        name: "",
        location_code: "",
        address: "",
        city: "",
        state: "",
        zip: "",
      }),
    };
  },

  methods: {
    createLocation() {
      this.form.post(route("locations.store"), {
        errorBag: "createLocation",
        preserveScroll: true,
      });
    },
  },
};
</script>
