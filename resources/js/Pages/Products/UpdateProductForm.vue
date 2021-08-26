<template>
  <div>
    <jet-form-section @submitted="updateProduct">
      <template #title>{{ product.name }}</template>

      <template #description> View and make changes to this product. </template>

      <template #form>
        <div class="col-span-6">
          <div class="grid gap-4">
            <div class="col-span-3">
              <jet-label for="name" value="Product Name" />
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
              <category-selector v-model="selectedCategory" />
              <jet-input-error
                :message="form.errors.category_id"
                class="mt-2"
              />
            </div>
            <div class="col-span-3">
              <jet-label for="description" value="Product Description" />
              <text-area-input
                id="description"
                class="mt-1 block w-full"
                v-model="form.description"
              />
              <jet-input-error
                :message="form.errors.description"
                class="mt-2"
              />
            </div>
          </div>
        </div>
      </template>

      <template #actions>
        <jet-button
          v-show="form.type"
          type="submit"
          :class="{ 'opacity-25': form.processing || !form.name }"
          :disabled="form.processing || !form.name"
          >Save Product</jet-button
        >
      </template>
    </jet-form-section>
  </div>
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

import CategorySelector from "./CategorySelector.vue";

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
    CategorySelector,
  },
  props: { product: Object },
  data() {
    return {
      selectedCategory: null,
      form: this.$inertia.form({
        _method: "PATCH",
        name: this.product.name,
        description: this.product.description,
        category_id: this.product.category_id,
        type: this.product.type,
      }),
    };
  },
  watch: {
    selectedCategory() {
      this.form.category_id = this.selectedCategory.id;
    },
  },
  methods: {
    updateProduct() {
      this.form.patch(route("products.update", this.product), {
        errorBag: "updateProduct",
        preserveScroll: true,
      });
    },
  },
};
</script>
