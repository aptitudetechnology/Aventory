<template>
  <jet-action-section>
    <template #title> Delete Location </template>

    <template #description> Delete this location. </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Once a location is deleted, all blocks in this location will be deleted,
        and all inventory in blocks at this nursery location will given an
        unnasigned location.
      </div>

      <div class="mt-5">
        <jet-danger-button @click="confirmLocationDeletion">
          Delete Location
        </jet-danger-button>
      </div>

      <!-- Delete Location Confirmation Modal -->
      <jet-confirmation-modal
        :show="confirmingLocationDeletion"
        @close="confirmingLocationDeletion = false"
      >
        <template #title> Delete Location </template>

        <template #content>
          Are you sure you want to delete this location?
        </template>

        <template #footer>
          <jet-secondary-button @click="confirmingLocationDeletion = false">
            Cancel
          </jet-secondary-button>

          <jet-danger-button
            class="ml-2"
            @click="deleteLocation"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Delete Location
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
  props: { location: Object },

  components: {
    JetActionSection,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingLocationDeletion: false,
      deleting: false,

      form: this.$inertia.form(),
    };
  },

  methods: {
    confirmLocationDeletion() {
      this.confirmingLocationDeletion = true;
    },

    deleteLocation() {
      this.form.delete(route("locations.destroy", this.location), {
        errorBag: "deleteLocation",
      });
    },
  },
};
</script>
