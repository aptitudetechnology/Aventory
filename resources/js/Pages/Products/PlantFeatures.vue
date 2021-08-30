<template>
  <div>
    <jet-form-section @submitted="updatePlantFeatures">
      <template #title>Plant Features</template>

      <template #description> Edit this plants features. </template>

      <template #form>
        <div class="col-span-6">
          <fieldset class="grid grid-cols-2 lg:grid-cols-3 gap-5">
            <legend class="sr-only">Features</legend>
            <div
              v-for="feature in features"
              :key="feature.id"
              class="relative flex items-start"
            >
              <div class="flex items-center h-5">
                <input
                  :id="feature.id"
                  name="features"
                  type="checkbox"
                  :value="feature.id"
                  v-model="form.features"
                  class="
                    focus:ring-green-500
                    h-4
                    w-4
                    text-green-600
                    border-gray-300
                    rounded
                  "
                />
              </div>
              <div class="ml-3 text-sm">
                <jet-label :for="feature.id">{{ feature.name }}</jet-label>
              </div>
            </div>
          </fieldset>
        </div>
      </template>

      <template #actions>
        <jet-button
          type="submit"
          :class="{ 'opacity-25': form.processing || !form.isDirty }"
          :disabled="form.processing || !form.isDirty"
          >Save Features</jet-button
        >
      </template>
    </jet-form-section>
  </div>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetLabel from "@/Jetstream/Label";

export default {
  components: {
    JetButton,
    JetFormSection,
    JetLabel,
  },
  props: { plant: { type: Object, required: true } },
  data() {
    return {
      features: this.$page.props.features,
      form: this.$inertia.form({
        _method: "PATCH",
        features: this.plant.features.map((feature) => feature.id),
      }),
    };
  },
  methods: {
    updatePlantFeatures() {
      this.form.patch(route("plant-features.update", this.plant), {
        errorBag: "updatePlantFeatures",
        preserveScroll: true,
      });
    },
  },
};
</script>
