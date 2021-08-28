<template>
  <jet-form-section @submitted="updateCategory">
    <template #title>{{ category.name }}</template>

    <template #description>
      Update this category. Products in this category will have the changes
      reflected immediately.
    </template>

    <template #form>
      <div class="col-span-6">
        <div class="grid gap-4">
          <div class="col-span-3">
            <jet-label for="name" value="Category Name" />
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
            <jet-label for="description" value="Category description" />
            <text-area-input
              id="description"
              class="mt-1 block w-full"
              v-model="form.description"
            />
            <jet-input-error :message="form.errors.description" class="mt-2" />
          </div>
        </div>
      </div>
    </template>

    <template #actions>
      <jet-button
        type="submit"
        :class="{ 'opacity-25': form.processing || !form.isDirty }"
        :disabled="form.processing || !form.isDirty"
        >Save Category</jet-button
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
  props: { category: Object },

  data() {
    return {
      form: this.$inertia.form({
        _method: "PATCH",
        name: this.category.name,
        description: this.category.description,
      }),
    };
  },
  methods: {
    updateCategory() {
      this.form.patch(route("categories.update", this.category), {
        errorBag: "updateCategory",
        preserveScroll: true,
        preserveState: false,
      });
    },
  },
};
</script>
