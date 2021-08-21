<template>
  <jet-action-section>
    <template #title> Delete Vendor </template>

    <template #description> Delete this vendor. </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Once a vendor is deleted, you will be unable to bring product in from
        this vendor. Past orders will still contain this vendor information.
      </div>

      <div class="mt-5">
        <jet-danger-button @click="confirmVendorDeletion">
          Delete Vendor
        </jet-danger-button>
      </div>

      <!-- Delete Vendor Confirmation Modal -->
      <jet-confirmation-modal
        :show="confirmingVendorDeletion"
        @close="confirmingVendorDeletion = false"
      >
        <template #title> Delete Vendor </template>

        <template #content>
          Are you sure you want to delete this vendor?
        </template>

        <template #footer>
          <jet-secondary-button @click="confirmingVendorDeletion = false">
            Cancel
          </jet-secondary-button>

          <jet-danger-button
            class="ml-2"
            @click="deleteVendor"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Delete Vendor
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
  props: { vendor: Object },

  components: {
    JetActionSection,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingVendorDeletion: false,
      deleting: false,

      form: this.$inertia.form(),
    };
  },

  methods: {
    confirmVendorDeletion() {
      this.confirmingVendorDeletion = true;
    },

    deleteVendor() {
      this.form.delete(route("vendors.destroy", this.vendor), {
        errorBag: "deleteVendor",
      });
    },
  },
};
</script>
