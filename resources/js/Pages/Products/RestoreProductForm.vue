<template>
  <jet-action-section>
    <template #title>Restore Product </template>

    <template #description
      >Restore this product. You will be able to create new orders and quotes
      with this product and will no longer be archived.</template
    >

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Once a product is restored, you will be able to create orders with this
        product.
      </div>

      <div class="mt-5">
        <jet-button @click="confirmProductRestoration">
          Restore Product
        </jet-button>
      </div>

      <!-- Restore Product Confirmation Modal -->
      <jet-confirmation-modal
        :show="confirmingProductRestoration"
        @close="confirmingProductRestoration = false"
      >
        <template #title> Restore Product </template>

        <template #content>
          Are you sure you want to restore this product?
        </template>

        <template #footer>
          <jet-secondary-button @click="confirmingProductRestoration = false">
            Cancel
          </jet-secondary-button>

          <jet-button
            class="ml-2"
            @click="RestoreProduct"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Restore Product
          </jet-button>
        </template>
      </jet-confirmation-modal>
    </template>
  </jet-action-section>
</template>

<script>
import JetActionSection from "@/Jetstream/ActionSection.vue";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

export default {
  props: ["product"],

  components: {
    JetActionSection,
    JetConfirmationModal,
    JetButton,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingProductRestoration: false,
      restoring: false,

      form: this.$inertia.form(),
    };
  },

  methods: {
    confirmProductRestoration() {
      this.confirmingProductRestoration = true;
    },

    RestoreProduct() {
      this.form.post(route("archived-products.restore", this.product.id), {
        errorBag: "restoreProduct",
      });
    },
  },
};
</script>
