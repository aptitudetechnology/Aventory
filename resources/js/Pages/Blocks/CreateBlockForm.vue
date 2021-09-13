<template>
  <jet-form-section @submitted="createBlock">
    <template #title>Create a Block</template>

    <template #description>
      Create a new nursery block where you sell or grow plants.
    </template>

    <template #form>
      <div class="grid col-span-6 gap-4">
        <div class="grid grid-cols-6 gap-2">
          <div class="col-span-6">
            <jet-label for="name" value="Block Name" />
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
          <SelectBox
            :items="locations"
            :selectedItem="selectedLocation"
            v-model="selectedLocation"
            labelValue="Select Nursery Location"
            class="col-span-5"
          />

          <div class="col-span-1 items-center">
            <jet-label for="has_places" value="Has places?" />
            <jet-checkbox id="has_places" v-model="form.has_places" required />
            <jet-input-error :message="form.errors.has_places" class="mt-2" />
          </div>
        </div>
      </div>
    </template>

    <template #actions>
      <jet-button
        type="submit"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
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
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import SelectBox from "@Components/SelectBox.vue";

export default {
  components: {
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetCheckbox,

    SelectBox,
  },

  data() {
    return {
      locations: this.$page.props.locations,
      selectedLocation: null,
      form: this.$inertia.form({
        _method: "POST",
        name: "",
        has_places: false,
        nursery_location_id: null,
      }),
    };
  },
  watch: {
    selectedLocation(location) {
      this.form.nursery_location_id = location.id;
    },
  },

  methods: {
    createBlock() {
      this.form.post(route("blocks.store"), {
        errorBag: "createBlock",
        preserveScroll: true,
      });
    },
  },
};
</script>
