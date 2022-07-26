<template>
  <jet-action-section>
    <template #title> Delete Block </template>

    <template #description> Delete this block. </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Once a block is deleted, all places in this block will be deleted, and
        all inventory assigned to this block will be given an unnasigned
        location.
      </div>

      <div class="mt-5">
        <jet-danger-button @click="confirmBlockDeletion">
          Delete Block
        </jet-danger-button>
      </div>

      <!-- Delete Block Confirmation Modal -->
      <jet-confirmation-modal
        :show="confirmingBlockDeletion"
        @close="confirmingBlockDeletion = false"
      >
        <template #title> Delete Block </template>

        <template #content>
          Are you sure you want to delete this block?
        </template>

        <template #footer>
          <jet-secondary-button @click="confirmingBlockDeletion = false">
            Cancel
          </jet-secondary-button>

          <jet-danger-button
            class="ml-2"
            @click="deleteBlock"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Delete Block
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
  props: { block: Object },

  components: {
    JetActionSection,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingBlockDeletion: false,
      deleting: false,

      form: this.$inertia.form(),
    };
  },

  methods: {
    confirmBlockDeletion() {
      this.confirmingBlockDeletion = true;
    },

    deleteBlock() {
      this.form.delete(route("blocks.destroy", this.block), {
        errorBag: "deleteBlock",
      });
    },
  },
};
</script>
