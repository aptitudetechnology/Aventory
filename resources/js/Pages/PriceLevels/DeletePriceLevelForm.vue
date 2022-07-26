<template>
  <jet-action-section>
    <template #title> Delete Price Level </template>

    <template #description>
      Delete {{ priceLevel.name }}. All customers in this price level will be
      set to base pricing.
    </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Once a price level is deleted, you will not be able to recover it again.
      </div>

      <div class="mt-5">
        <jet-danger-button @click="confirmPriceLevelDeletion">
          Delete Price Level
        </jet-danger-button>
      </div>

      <!-- Delete Customer Confirmation Modal -->
      <jet-confirmation-modal
        :show="confirmingPriceLevelDeletion"
        @close="confirmingPriceLevelDeletion = false"
      >
        <template #title> Delete Price Level </template>

        <template #content>
          Are you sure you want to delete this price level?
        </template>

        <template #footer>
          <jet-secondary-button @click="confirmingPriceLevelDeletion = false">
            Cancel
          </jet-secondary-button>

          <jet-danger-button
            class="ml-2"
            @click="deletePriceLevel"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Delete Price Level
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>
    </template>
  </jet-action-section>
</template>

<script>
import JetActionSection from "@/Jetstream/ActionSection";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
  props: { priceLevel: Object },

  components: {
    JetActionSection,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingPriceLevelDeletion: false,
      deleting: false,

      form: this.$inertia.form(),
    };
  },

  methods: {
    confirmPriceLevelDeletion() {
      this.confirmingPriceLevelDeletion = true;
    },

    deletePriceLevel() {
      this.form.delete(
        route("customer-price-levels.destroy", this.priceLevel),
        {
          errorBag: "deletePriceLevel",
        }
      );
    },
  },
};
</script>
