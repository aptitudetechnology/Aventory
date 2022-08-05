<template>
  <jet-action-section>
    <template #title> Delete Feature </template>

    <template #description>
      Delete {{ feature.name }}. All products containing this feature will no
      longer have it.
    </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Once a feature is deleted, you will not be able to recover it again.
      </div>

      <div class="mt-5">
        <jet-danger-button @click="confirmFeatureDeletion">
          Delete Feature
        </jet-danger-button>
      </div>

      <!-- Delete Feature Confirmation Modal -->
      <jet-confirmation-modal
        :show="confirmingFeatureDeletion"
        @close="confirmingFeatureDeletion = false"
      >
        <template #title> Delete Feature </template>

        <template #content>
          Are you sure you want to delete this feature?
        </template>

        <template #footer>
          <jet-secondary-button @click="confirmingFeatureDeletion = false">
            Cancel
          </jet-secondary-button>

          <jet-danger-button
            class="ml-2"
            @click="deleteFeature"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Delete Feature
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
  props: { feature: Object },

  components: {
    JetActionSection,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingFeatureDeletion: false,
      deleting: false,

      form: this.$inertia.form(),
    };
  },

  methods: {
    confirmFeatureDeletion() {
      this.confirmingFeatureDeletion = true;
    },

    deleteFeature() {
      this.form.delete(route("features.destroy", this.feature), {
        errorBag: "deleteFeature",
      });
    },
  },
};
</script>
