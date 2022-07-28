<template>
  <jet-action-section>
    <template #title> Delete Product </template>

    <template #description> Delete this product. </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Once a product is deleted, you will be unable to create orders for this
        product. Past orders will still be displayed for the product.
      </div>

      <div class="mt-5">
        <jet-danger-button @click="confirmProductDeletion">
          Delete Product
        </jet-danger-button>
      </div>

      <!-- Delete Product Confirmation Modal -->
      <jet-confirmation-modal
        :show="confirmingProductDeletion"
        @close="confirmingProductDeletion = false"
      >
        <template #title> Delete Product </template>

        <template #content>
          Are you sure you want to delete this product?
        </template>

        <template #footer>
          <jet-secondary-button @click="confirmingProductDeletion = false">
            Cancel
          </jet-secondary-button>

          <jet-danger-button
            class="ml-2"
            @click="deleteProduct"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Delete Product
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
  props: ["product"],

  components: {
    JetActionSection,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingProductDeletion: false,
      deleting: false,

      form: this.$inertia.form(),
    };
  },

  methods: {
    confirmProductDeletion() {
      this.confirmingProductDeletion = true;
    },

    deleteProduct() {
      this.form.delete(route("products.destroy", this.product), {
        errorBag: "deleteProduct",
      });
    },
  },
};
</script>
