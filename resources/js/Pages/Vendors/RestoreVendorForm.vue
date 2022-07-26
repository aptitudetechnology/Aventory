<template>
  <jet-action-section>
    <template #title>Restore Vendor </template>

    <template #description
      >Restore this vendor. You will be able to bring in new inventory with this
      vendor and it will no longer be archived.</template
    >

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Once a vendor is restored, you will be able to bring in inventory from
        this vendor.
      </div>

      <div class="mt-5">
        <jet-button @click="confirmVendorRestoration">
          Restore Vendor
        </jet-button>
      </div>

      <!-- Restore Vendor Confirmation Modal -->
      <jet-confirmation-modal
        :show="confirmingVendorRestoration"
        @close="confirmingVendorRestoration = false"
      >
        <template #title> Restore Vendor </template>

        <template #content>
          Are you sure you want to restore this vendor?
        </template>

        <template #footer>
          <jet-secondary-button @click="confirmingVendorRestoration = false">
            Cancel
          </jet-secondary-button>

          <jet-button
            class="ml-2"
            @click="restoreVendor"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Restore Vendor
          </jet-button>
        </template>
      </jet-confirmation-modal>
    </template>
  </jet-action-section>
</template>

<script>
import JetActionSection from "@/Jetstream/ActionSection";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
  props: ["vendor"],

  components: {
    JetActionSection,
    JetConfirmationModal,
    JetButton,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingVendorRestoration: false,
      restoring: false,

      form: this.$inertia.form(),
    };
  },

  methods: {
    confirmVendorRestoration() {
      this.confirmingVendorRestoration = true;
    },

    restoreVendor() {
      this.form.post(route("archived-vendors.restore", this.vendor.id), {
        errorBag: "restoreVendor",
      });
    },
  },
};
</script>
