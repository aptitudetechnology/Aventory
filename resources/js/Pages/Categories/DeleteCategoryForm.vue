<template>
  <jet-action-section>
    <template #title> Delete Category </template>

    <template #description>
      Delete {{ category.name }}. All products in this category will no longer
      have a category until you reassign their category.
    </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Once a category is deleted, you will not be able to recover it again.
      </div>

      <div class="mt-5">
        <jet-danger-button @click="confirmCategoryDeletion">
          Delete Category
        </jet-danger-button>
      </div>

      <!-- Delete Category Confirmation Modal -->
      <jet-confirmation-modal
        :show="confirmingCategoryDeletion"
        @close="confirmingCategoryDeletion = false"
      >
        <template #title> Delete Category </template>

        <template #content>
          Are you sure you want to delete this category?
        </template>

        <template #footer>
          <jet-secondary-button @click="confirmingCategoryDeletion = false">
            Cancel
          </jet-secondary-button>

          <jet-danger-button
            class="ml-2"
            @click="deleteCategory"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Delete Category
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>
    </template>
  </jet-action-section>
</template>

<script>
import JetActionSection from "@/Jetstream/ActionSection.vue";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

export default {
  props: { category: Object },

  components: {
    JetActionSection,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingCategoryDeletion: false,
      deleting: false,

      form: this.$inertia.form(),
    };
  },

  methods: {
    confirmCategoryDeletion() {
      this.confirmingCategoryDeletion = true;
    },

    deleteCategory() {
      this.form.delete(route("categories.destroy", this.category), {
        errorBag: "deleteCategory",
      });
    },
  },
};
</script>
